<?php namespace Laravelista\Bard\Interfaces;

use Symfony\Component\HttpFoundation\Response;

interface Renderable {

    /**
     * @return Response
     */
    public function render();
}