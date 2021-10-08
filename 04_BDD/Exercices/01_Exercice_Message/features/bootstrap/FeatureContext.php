<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use App\Message;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    protected Message $message;
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->message = new Message();
    }

    /**
     * @Given j'ai un nouveau message :arg1
     */
    public function jaiUnNouveauMessage($message)
    {
        try {
            var_dump("scenario 1", $message);
            $this->message->set($message);

        } catch (\TypeError $e) {

            var_dump("Type Error");
        }

        
    }

    /**
     * @Then je dois voir s'afficher :arg1
     */
    public function jeDoisVoirSafficher($message)
    {
        if ($this->message->get() !== strtoupper($message))
            throw new Exception("Le message n'est pas en majuscule!");

        var_dump("scenario", $this->message->get());
    }

    /**
     * @Given j'ai un nouveau premier message :arg1
     */
    public function jaiUnNouveauPremierMessage($message)
    {
        $this->message->set($message);
        if (empty($this->message->get())) throw new Exception("Attention il y a un problème d'enregistrement");

        var_dump("scenario 2 part1", $this->message->get());
    }

    /**
     * @Given j'ai un autre message :arg1
     */
    public function jaiUnAutreMessage($message)
    {
        $this->message->set($message);
        if (empty($this->message->get())) throw new Exception("Attention il y a un problème d'enregistrement");

        var_dump("scenario 2 part2", $this->message->get());
    }

    /**
     * @Then je dois avoir une exception :arg1
     */
    public function jeDoisAvoirUneException($error)
    {
        var_dump($error);
    }
}
