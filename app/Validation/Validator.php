<?php 

namespace App\Validation;

use App\MainContainer;
use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator extends MainContainer
{

    protected $errors;
    protected $success;

    /**
     * Validate the user input from the form
     *
     * @param  Request  $request  request object
     * @param  array    $rules  rules array
     * @return object          Return the current object.
     */
    public function validate($request, array $rules)
    {    
        // $this->logger->info("Starting the validation for the form field");

        foreach ($rules as $field => $rule) {
            try {
                $rule->setName(ucfirst($field))->assert($request->getParam($field));
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }

        $_SESSION['errors'] = $this->errors;

        return $this;
    }

    /**
     * Check if there were errors in the form
     *
     * @param  Request  $req  request object
     * @param  Response $res  response object
     * @param  array   $args  arguments array
     * @return mixed          return the current page.
     */
    public function failed()
    {
        // $this->logger->info("Checking for errors in the form.");
        
        if (!empty($this->errors)) {
            // $this->logger->warning("Encountered ". count($this->errors) ." in the form.");
            return $this->errors;
        } else {
            // $this->logger->info("No errors found in the form.");
        }
    }
}