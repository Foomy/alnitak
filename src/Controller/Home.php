<?php

namespace Application\Controller;

class Home extends AbstractController
{
    public function index(): void
    {
        echo sprintf(<<<HEREDOC
<h1>Welcum</h1>
<p>You are here: %s</p>
HEREDOC,
        __METHOD__
        );

    }
}