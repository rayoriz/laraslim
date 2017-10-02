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
        
        if (!empty($this->errors)) {
            return $this->errors;
        } else {
        }
    }
}