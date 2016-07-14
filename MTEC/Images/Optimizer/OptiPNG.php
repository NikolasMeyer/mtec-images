<?php

namespace MTEC\Images\Optimizer {
    class OptiPNG extends \MTEC\Images\Optimizer {

        protected $_binaryPath = '/usr/bin/optipng';

        protected function _doOptimization(\MTEC\Images\Image $image) {
            $src = $image->getSrc();

            $output = null;
            $returnVar = null;
            $command = [$this->_binaryPath, '-o2', $src];

            $result = $this->_exec($command);
        }
    }
}
