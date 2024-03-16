<?php

namespace App\Controller;

use App\Entity\Address;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class SecurityController extends AbstractController
{
    private UserRepository $userRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): never
    {
        // controller can be blank: it will never be called!
        throw new RuntimeException('It will never be fired trust Rash haha !');
    }


    #[Route('/webhooks', name: 'app_webhook_initiate', methods: ['GET'])]
    public function webhookInitiate(Request $request): Response
    {
        $token = $request->query->get('hub_verify_token');
        $challenge = $request->query->get('hub_challenge');
        $mode = $request->query->get('hub_mode');
        // check the mode and token sent are correct
        if ($mode === "subscribe" && $token === 'toto') {
            // respond with 200 OK and challenge token from the request
            return new Response($challenge, 200);
        }else {
            return new Response('Error when verifying', 403);
        }
    }

    #[Route('/webhooks', name: 'app_webhooks', methods: ['POST'])]
    public function webhooks(Request $request): Response
    {
        try{
            $change = isset(json_decode($request->getContent(), true)['entry'][0]['changes'][0]['value']) && isset(json_decode($request->getContent(), true)['entry'][0]['changes'][0]['value']) ? json_decode($request->getContent(), true)['entry'][0]['changes'][0]['value'] : null;
            $message = $change && isset($change['messages']) ? $change['messages'][0] : null;
            $statuses = $change && isset($change['statuses']) ? $change['statuses'][0] : null;

            if($message && isset($message['location'])){
                $return = 'Message de : '. $message['from'] . ' longitude : ' . $message['location']['longitude'] . ' Latitude : '. $message['location']['latitude'];
                $user = $this->userRepository->findOneBy([
                    'phoneNumber' => $message['from']
                ]);
                if(!$user){
                    return $this->json(
                        [
                            'User not found in the db with the provided number'
                        ],
                        404
                    );
                }

                $address = new Address();
                $address->setUser($user);
                $address->setLatitude($message['location']['latitude']);
                $address->setLongitude($message['location']['longitude']);
                $address->setCreatedAt(new \DateTime('now'));
                $address->setComment('ninja');
                $this->entityManager->persist($address);
                $this->entityManager->flush();
                $status = 200;
            }elseif($message && $message['text']) {
                $return = 'Message de : '. $message['from'] . '. Message : '. $message['text']['body'];
                $status = 200;
            }elseif ($statuses && $statuses['status'] === 'sent'){
                $return = 'Message envoyé';
                $status = 200;
            }elseif ($statuses && $statuses['status'] === 'delivered'){
                $return = 'Message distribué';
                $status = 200;
            }
            return $this->json(
                [
                    $return ?? [
                        'result' => $change,
                        'message' => 'Return not managed by the API',
                        'path_name' => 'app_webhooks [POST]',
                    ]
                ],
                $status ?? 500
            );
        }catch(Throwable $exception){
            return $this->json(
                [
                    $exception->getMessage()
                ],
                $exception->getCode()
            );
        }
    }
}
