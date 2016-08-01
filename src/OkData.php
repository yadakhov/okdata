<?php

namespace Yadakhov;

/**
 * A wrapper class for the OkData Json Api specifications.
 *
 * @see http://okdata.github.io
 */
class OkData
{
    /**
     * @var boolean
     */
    protected $ok;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var string The error message.
     */
    protected $error;

    /**
     * OkData constructor.
     *
     * @param bool $ok
     * @param null|array $data
     * @param null|string $error
     */
    public function __construct($ok = true, $data = null, $error = null)
    {
        $this->setOk($ok);
        $this->setData($data);
        $this->setError($error);
    }

    /**
     * Get an instance of the object.
     *
     * @param bool $ok
     * @param null|array $data
     * @param null|string $error
     *
     * @return OkData
     */
    public static function getInstance($ok = true, $data = null, $error = null)
    {
        return new OkData($ok, $data, $error);
    }

    /**
     * Get error instance.
     *
     * @param null|string $error
     * @param null|array $data
     *
     * @return OkData
     */
    public static function getErrorInstance($error = null, $data = null)
    {
        return new OkData(false, $data, $error);
    }

    /**
     * Returns true if ok is true.
     *
     * @return bool
     */
    public function isOk()
    {
        return $this->ok === true;
    }

    /**
     * Return true if ok is false.
     *
     * @return bool
     */
    public function isError()
    {
        return $this->ok === false;
    }

    /**
     * Returns the array representation of the object.
     *
     * @return array the array representation of the object.
     */
    public function toArray()
    {
        if ($this->ok) {
            $json = [
                'ok' => $this->getOk(),
                'data' => $this->getData(),
            ];
        } else {
            $json = [
                'ok' => $this->getOk(),
                'error' => $this->getError(),
            ];

            if (isset($this->data)) {
                $json['data'] = $this->getData();
            }
        }

        return $json;
    }

    /**
     * Returns the encoded OkData object.
     *
     * @return string the encoded OkData object.
     */
    public function toString()
    {
        return json_encode($this->toArray());
    }

    /**
     * Auto to string method.
     *
     * @return string the string representation of the object.
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * Alias for toString()
     *
     * @return string the string representation of the object.
     */
    public function toJson()
    {
        return $this->toString();
    }

    /**
     * Returns the status.
     *
     * @return string the status.
     */
    public function getOk()
    {
        return $this->ok;
    }

    /**
     * Set ok.
     *
     * @param $ok
     *
     * @return $this
     */
    public function setOk($ok)
    {
        if (!is_bool($ok)) {
            throw new \InvalidArgumentException($ok . ' needs to be a boolean.');
        }

        $this->ok = $ok;

        return $this;
    }

    /**
     * Returns the data.
     *
     * @return array the data.
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the data.
     *
     * @param null|array|mixed $data
     *
     * @return $this
     */
    public function setData(array $data = null)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the error message.
     *
     * @return null|string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Set the error message.
     *
     * @param $error
     *
     * @return $this
     */
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * Add to the data array.
     *
     * @param $key
     * @param $value
     *
     * @return OkData $this
     */
    public function addData($key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }
}
