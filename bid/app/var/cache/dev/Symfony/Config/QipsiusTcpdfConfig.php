<?php

namespace Symfony\Config;

require_once __DIR__.\DIRECTORY_SEPARATOR.'QipsiusTcpdf'.\DIRECTORY_SEPARATOR.'TcpdfConfig.php';

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class QipsiusTcpdfConfig implements \Symfony\Component\Config\Builder\ConfigBuilderInterface
{
    private $file;
    private $class;
    private $tcpdf;
    private $_usedProperties = [];

    /**
     * @default '%kernel.project_dir%/vendor/tecnickcom/tcpdf/tcpdf.php'
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function file($value): static
    {
        $this->_usedProperties['file'] = true;
        $this->file = $value;

        return $this;
    }

    /**
     * @default 'TCPDF'
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function class($value): static
    {
        $this->_usedProperties['class'] = true;
        $this->class = $value;

        return $this;
    }

    /**
     * @default {"k_path_url":"%kernel.project_dir%\/vendor\/tecnickcom\/tcpdf\/","k_path_main":"%kernel.project_dir%\/vendor\/tecnickcom\/tcpdf\/","k_path_fonts":"%kernel.project_dir%\/vendor\/tecnickcom\/tcpdf\/fonts\/","k_path_cache":"%kernel.cache_dir%\/tcpdf","k_path_url_cache":"%kernel.cache_dir%\/tcpdf","k_path_images":"%kernel.project_dir%\/vendor\/tecnickcom\/tcpdf\/examples\/images\/","k_blank_image":"%kernel.project_dir%\/vendor\/tecnickcom\/tcpdf\/examples\/images\/_blank.png","k_cell_height_ratio":1.25,"k_title_magnification":1.3,"k_small_ratio":0.6666666666666666,"k_thai_topchars":true,"k_tcpdf_calls_in_html":false,"k_allowed_tcpdf_tags":"","k_tcpdf_external_config":true,"k_tcpdf_throw_exception_error":true,"head_magnification":1.1,"pdf_page_format":"A4","pdf_page_orientation":"P","pdf_creator":"TCPDF","pdf_author":"TCPDF","pdf_header_title":"","pdf_header_string":"","pdf_header_logo":"","pdf_header_logo_width":"","pdf_unit":"mm","pdf_margin_header":5,"pdf_margin_footer":10,"pdf_margin_top":27,"pdf_margin_bottom":25,"pdf_margin_left":15,"pdf_margin_right":15,"pdf_font_name_main":"helvetica","pdf_font_size_main":10,"pdf_font_name_data":"helvetica","pdf_font_size_data":8,"pdf_font_monospaced":"courier","pdf_image_scale_ratio":1.25}
    */
    public function tcpdf(array $value = []): \Symfony\Config\QipsiusTcpdf\TcpdfConfig
    {
        if (null === $this->tcpdf) {
            $this->_usedProperties['tcpdf'] = true;
            $this->tcpdf = new \Symfony\Config\QipsiusTcpdf\TcpdfConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "tcpdf()" has already been initialized. You cannot pass values the second time you call tcpdf().');
        }

        return $this->tcpdf;
    }

    public function getExtensionAlias(): string
    {
        return 'qipsius_tcpdf';
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('file', $value)) {
            $this->_usedProperties['file'] = true;
            $this->file = $value['file'];
            unset($value['file']);
        }

        if (array_key_exists('class', $value)) {
            $this->_usedProperties['class'] = true;
            $this->class = $value['class'];
            unset($value['class']);
        }

        if (array_key_exists('tcpdf', $value)) {
            $this->_usedProperties['tcpdf'] = true;
            $this->tcpdf = new \Symfony\Config\QipsiusTcpdf\TcpdfConfig($value['tcpdf']);
            unset($value['tcpdf']);
        }

        if ([] !== $value) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($value)));
        }
    }

    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['file'])) {
            $output['file'] = $this->file;
        }
        if (isset($this->_usedProperties['class'])) {
            $output['class'] = $this->class;
        }
        if (isset($this->_usedProperties['tcpdf'])) {
            $output['tcpdf'] = $this->tcpdf->toArray();
        }

        return $output;
    }

}
