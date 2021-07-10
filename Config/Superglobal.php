<?php


namespace Config;

class Superglobal
{
    /**
     * @var array
     */
    private array $_post;

    /**
     * @var array
     */
    private array $_get;

    /**
     * @var array
     */
    private array $_session;

    /**
     * @var array
     */
    private array $_server;

    public function __construct()
    {
        $this->_post = $_POST;
        $this->_get = $_GET;
        $this->_session = $_SESSION;
        $this->_server = $_SERVER;
    }

    /**
     * @param null $key
     * @param null $default
     * @return mixed|null
     */
    public function getPost($key = null, $default = null)
    {
        return $this->checkGlobal($this->_post, $key, $default);
    }

    /**
     * @param null $key
     * @param null $default
     * @return mixed|null
     */
    public function getGet($key = null, $default = null)
    {
        return $this->checkGlobal($this->_get, $key, $default);
    }

    /**
     * @param null $key
     * @param null $default
     * @return mixed|null
     */
    public function getSession($key = null, $default = null)
    {
        return $this->checkGlobal($this->_session, $key, $default);
    }

    /**
     * @param null $key
     * @param null $default
     * @return mixed|null
     */
    public function getServer($key = null, $default = null)
    {
        return $this->checkGlobal($this->_server, $key, $default);
    }


    public function setPost($key, $value)
    {
        return  $this -> setCheckGlobal('post', $key, $value);
    }


    public function setSession($key, $value)
    {
        return $this->setCheckGlobal('session', $key, $value);
    }


    private function setCheckGlobal($global, $key, $value)
    {
        $var = '_'.$global;
        return $this->$var[$key] = $value;
    }




    private function checkGlobal($global, $key = null, $default = null)
    {
        if ($key) {
            return $global[ $key ] ?? ($default ?: null);
        }
        return $global;
    }
}
