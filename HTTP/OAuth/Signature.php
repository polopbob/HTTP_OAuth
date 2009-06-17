<?php
/**
 * HTTP_OAuth
 *
 * PHP version 5.2.0+
 *
 * LICENSE: This source file is subject to the New BSD license that is
 * available through the world-wide-web at the following URI:
 * http://www.opensource.org/licenses/bsd-license.php. If you did not receive  
 * a copy of the New BSD License and are unable to obtain it through the web, 
 * please send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category  HTTP
 * @package   HTTP_OAuth
 * @author    Jeff Hodsdon <jeffhodsdon@gmail.com> 
 * @copyright 2009 Jeff Hodsdon <jeffhodsdon@gmail.com> 
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://pear.php.net/package/HTTP_OAuth_Provider
 * @link      http://github.com/jeffhodsdon/HTTP_OAuth_Provider
 */

require_once 'HTTP/OAuth.php';
require_once 'HTTP/OAuth/Message/Signable.php';

/**
 * HTTP_OAuth_Signature
 * 
 * @category  HTTP
 * @package   HTTP_OAuth
 * @copyright 2009 Jeff Hodsdon <jeffhodsdon@gmail.com> 
 * @author    Jeff Hodsdon <jeffhodsdon@gmail.com> 
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class HTTP_OAuth_Signature
{

    /**
     * Build 
     * 
     * @param HTTP_OAuth_Message_Signable $message Message to sign
     *
     * @return string Signature
     */
    static public function build(HTTP_OAuth_Message_Signable $message)
    {
        return self::factory($method)->build(
            $message->getRequestMethod(),
            $message->getUrl(),
            $message->getParameters(),
            $message->getSecrets()
        );
    }

    /**
     * Factory
     * 
     * @param string $method Signature method
     *
     * @return HTTP_OAuth_Signature_Common Signature instance
     */
    static public function factory($method)
    {
        $method = str_replace('-', '_', $method);
        $class  = 'HTTP_OAuth_Signature_' . $method;
        $file   = str_replace('_', '/', $class) . '.php';

        include_once $file;

        return new $class;
    }
}

?>
