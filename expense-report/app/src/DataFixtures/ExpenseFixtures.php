<?php

namespace App\DataFixtures;

use App\Entity\Expense;
use App\Entity\ExpenseItem;
use App\Enum\ExpenseTypeString;
use App\Service\ExpenseService;
use DateInterval;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Faker;

class ExpenseFixtures extends Fixture implements DependentFixtureInterface
{
    private const NB_EXPENSES = 100;

    private $faker;
    private WorkflowInterface $expenseWorkflow;
    private ExpenseService $expenseService;

    public function __construct(WorkflowInterface $expenseWorkflow, ExpenseService $expenseService)
    {
        $this->faker = Faker\Factory::create();
        $this->expenseWorkflow = $expenseWorkflow;
        $this->expenseService = $expenseService;
    }

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        /** Expenses **/
        // create random expenses
        $user1Id = 8;
        $nbUser = 50;
        for ($i = 0; $i < self::NB_EXPENSES; $i++) {
            $expense = new Expense();
            $expenseItem1 = new ExpenseItem();
            $expenseItem2 = new ExpenseItem();
            $expense->setTotalAmount(0);
            $expense->setAdvancedTotalAmount(0);
            $expense->setDate((new DateTime('now'))->add(new Dateinterval('P'.($i+1).'D')));
            $expense->setDateCreation((new DateTime('now')));
            $expense->setStatus(Expense::STATUS_DRAFT);

            $expenseItem1->setAmount($this->faker->numberBetween(25000, 100000));
            $expenseItem2->setAmount($this->faker->numberBetween(25000, 100000));
            if($i%2 == 0){
                $expenseItem1->setIsAdvanceTaken(true);
                $expenseItem1->setAdvancedFeesAmount($this->faker->numberBetween(2500, 40000));
                $expenseItem2->setIsAdvanceTaken(true);
                $expenseItem2->setAdvancedFeesAmount($this->faker->numberBetween(2500, 40000));
            }else {
                $expenseItem1->setIsAdvanceTaken(0);
                $expenseItem1->setAdvancedFeesAmount(0);
                $expenseItem2->setIsAdvanceTaken(0);
                $expenseItem2->setAdvancedFeesAmount(0);
            }
            $expenseItem1->setExpenseType(ExpenseTypeString::TYPE_VOITURE->name);
            $expenseItem2->setExpenseType(ExpenseTypeString::TYPE_VOITURE->name);
            $expenseItem1->setComment($this->faker->paragraph());
            $expenseItem2->setComment($this->faker->paragraph());
            $expenseItem1->setExpense($expense);
            $expenseItem2->setExpense($expense);
            $expense->addExpenseItem($expenseItem1);
            $expense->addExpenseItem($expenseItem2);
            $amounts = $this->expenseService->getExpenseTotalAmount($expense);
            $expense->setAdvancedTotalAmount($amounts['advancedAmountTotal']);
            $expense->setTotalAmount($amounts['amountTotal']);
            if($this->expenseWorkflow->can($expense, Expense::STATUS_TO_REVIEW_ACCOUNTING)){
                $this->expenseWorkflow->apply($expense, Expense::STATUS_TO_REVIEW_ACCOUNTING);
                $expense->setStatus(Expense::STATUS_TO_REVIEW_ACCOUNTING);
            }
            if($i < $nbUser){
                $expense->setUser($this->getReference('user_'. ($i+1)));
            }else{
                $expense->setUser($this->getReference('user_'. $user1Id));
            }
            $manager->persist($expense);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
