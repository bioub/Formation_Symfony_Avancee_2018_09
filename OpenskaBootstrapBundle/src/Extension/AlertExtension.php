<?php

namespace Openska\BootstrapBundle\Extension;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AlertExtension extends AbstractExtension
{
    /** @var FlashBagInterface */
    protected $flashBag;

    /**
     * AlertExtension constructor.
     * @param FlashBagInterface $flashBag
     */
    public function __construct(FlashBagInterface $flashBag)
    {
        $this->flashBag = $flashBag;
    }


    public function getFunctions()
    {
        return [
            new TwigFunction('btspAlert', [$this, 'alert'], ['is_safe' => ['html']]),
            new TwigFunction('btspFlashAlert', [$this, 'flashAlert'], ['is_safe' => ['html']]),
        ];
    }

    public function alert($msg, $type = 'success')
    {
        // TODO espace $msg et $type
        return "<div class=\"alert alert-$type\">$msg</div>";
    }

    public function flashAlert($type = 'success')
    {
        $messages = $this->flashBag->get($type);
        $html = '';

        foreach ($messages as $message) {
            $html .= $this->alert($message, $type);
        }

        return $html;
    }
}