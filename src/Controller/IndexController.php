<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic\Controller;

use Zend\Console\Request as ConsoleRequest;
use Zend\Math\Rand;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class IndexController
 * @package MSBios\Assetic\Controller
 */
class IndexController extends AbstractActionController
{
    /**
     * @return string
     */
    public function resetpasswordAction()
    {
        echo __METHOD__;
        die();
        $request = $this->getRequest();

        // Make sure that we are running in a console, and the user has not
        // tricked our application into running this action from a public web
        // server:
        if (! $request instanceof ConsoleRequest) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

        // Get user email from the console, and check if the user requested
        // verbosity:
        $userEmail   = $request->getParam('userEmail');
        $verbose     = $request->getParam('verbose') || $request->getParam('v');

        // Reset new password
        $newPassword = Rand::getString(16);

        // Fetch the user and change his password, then email him ...
        /* ... */

        if ($verbose) {
            return "Done! New password for user $userEmail is '$newPassword'. "
                . "It has also been emailed to him.\n";
        }

        return "Done! $userEmail has received an email with his new password.\n";
    }
}
