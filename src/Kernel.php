<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

// This is kernel
// MBA
class Kernel extends BaseKernel
{
    use MicroKernelTrait;
}
