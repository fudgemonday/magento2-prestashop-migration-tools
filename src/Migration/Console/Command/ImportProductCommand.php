<?php

namespace Mimlab\PrestashopMigrationTool\Console\Command;

use Magento\Framework\ObjectManagerInterface;
use Mimlab\PrestashopMigrationTool\Model\Product;
use Mimlab\PrestashopMigrationTool\Model\ProductFactory;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ImportProductCommand
 *
 * @package Mimlab\PrestashopMigrationTool\Console\Command
 */
class ImportProductCommand extends ImportCommand
{
    /**
     * Type of migration
     */
    const TYPE_IMPORT = 'catalog_products';

    /**
     * @var ProductFactory
     */
    private $productFactory;

    /**
     * ProductCommand constructor.
     *
     * @param ImportProductFactory $productFactory
     * @param ObjectManagerInterface $objectManager
     * @param null $name
     */
    public function __construct(
        ProductFactory $productFactory,
        ObjectManagerInterface $objectManager,
        $name = null
    ) {
        
        $this->productFactory = $productFactory;
        parent::__construct($objectManager, $name);
    }

    /**
     * Execute command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Product $product */
        $product = $this->productFactory->create();
        if ($dirInputPath = $input->getOption(parent::INPUT_KEY_FLOW_DIR)) {
            $product->setFlowDir($dirInputPath);
        }
        $product->execute(self::TYPE_IMPORT, $output);
    }
}
