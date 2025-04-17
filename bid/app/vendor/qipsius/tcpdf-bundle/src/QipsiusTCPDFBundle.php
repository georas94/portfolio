<?php

namespace Qipsius\TCPDFBundle;

use Qipsius\TCPDFBundle\DependencyInjection\QipsiusTCPDFExtension;
use RuntimeException;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class QipsiusTCPDFBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return dirname(__DIR__);
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new QipsiusTCPDFExtension();
    }

    /**
     * Ran on bundle boot, our TCPDF configuration constants get defined here if required.
     */
    public function boot(): void
    {
        if (!$this->container->hasParameter('qipsius_tcpdf.tcpdf')) {
            return;
        }

        // Define our TCPDF variables
        $config = $this->container->getParameter('qipsius_tcpdf.tcpdf');

        // TCPDF needs some constants defining if our configuration determines we should do so (default true)
        // Set tcpdf.k_tcpdf_external_config to false to use the TCPDF core defaults
        if ($config['k_tcpdf_external_config']) {
            foreach ($config as $k => $v) {
                $constKey = strtoupper($k);

                if (!defined($constKey)) {
                    $value = $this->container->getParameterBag()->resolveValue($v);

                    // All K_ constants are required
                    if (0 === stripos($k, 'k_')) {
                        if (('k_path_cache' === $k || 'k_path_url_cache' === $k) && !is_dir($value)) {
                            $this->createDirectory($value);
                        }

                        if (in_array($constKey, [
                            'K_PATH_URL',
                            'K_PATH_MAIN',
                            'K_PATH_FONTS',
                            'K_PATH_CACHE',
                            'K_PATH_URL_CACHE',
                            'K_PATH_IMAGES',
                        ])) {
                            $value .= (str_ends_with($value, '/') ? '' : '/');
                        }
                    }
                    define($constKey, $value);
                }
            }
        }
    }

    /**
     * @throws RuntimeException
     */
    private function createDirectory(string $filePath): void
    {
        $filesystem = new Filesystem();
        if (false === $filesystem->mkdir($filePath)) {
            throw new RuntimeException(sprintf('Could not create directory %s', $filePath));
        }
    }
}
