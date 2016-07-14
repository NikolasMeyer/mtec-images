<?php

namespace MTEC\Images\Optimizer {
    class JPEGOptim extends \MTEC\Images\Optimizer {

        protected $_binaryPath = '/usr/bin/jpegoptim';

        protected function _doOptimization(\MTEC\Images\Image $image) {
            $src = $image->getSrc();

            $output = null;
            $returnVar = null;
            $command = [$this->_binaryPath, '--strip-all', $src];

            $result = $this->_exec($command);
        }
    }
}
