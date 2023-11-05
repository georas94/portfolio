<?php

namespace App\Service;

use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;
use Throwable;

class DocumentService
{
    private Filesystem $filesystemService;
    private ParameterBagInterface $params;
    public function __construct(Filesystem $filesystemService, ParameterBagInterface $params)
    {
        $this->filesystemService = $filesystemService;
        $this->params = $params;
    }

    /**
     * @throws Exception
     */
    public function deleteLocalDocument(string $filename): bool
    {
        try {
            $this->filesystemService->remove($this->params->get('expense_documents_directory').'/'.$filename);
            return true;
        }catch (Throwable $exception){
            throw new Exception('Error when deleting document : '. $exception->getMessage());
        }
    }
}