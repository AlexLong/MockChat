<?php
/**
 * 
 * User: Windows
 * Date: 3/28/14
 * Time: 7:56 PM
 * 
 */

namespace Application\Model;


use Zend\Session\SaveHandler\MongoDB;

class AppMongoDb extends MongoDB{

    /**
     * Read session data
     *
     * @param string $id
     * @return string
     */



    public function read($id)
    {
        $session = $this->mongoCollection->findOne(array(
            '_id' => $id,
            $this->options->getNameField() => $this->sessionName,
        ));

        if (null !== $session) {
            $data_field = $this->options->getDataField();

            $decoded = json_decode( $session[$data_field],true);
            $session[$data_field] = $decoded;

            if ($session[$this->options->getModifiedField()] instanceof \MongoDate &&
                $session[$this->options->getModifiedField()]->sec +
                $session[$this->options->getLifetimeField()]->sec > time()) {

                $_SESSION = $session[$data_field];
            var_dump($_SESSION);

            }
            $this->destroy($id);
        }

        return '';
    }

    /**
     * Write session data
     *
     * @param string $id
     * @param string $data
     * @return bool
     */


    public function write($id, $data)
    {

        $saveOptions = array_replace(
            $this->options->getSaveOptions(),
            array('upsert' => true, 'multiple' => false)
        );

        $criteria = array(
            '_id' => $id,
            $this->options->getNameField() => $this->sessionName,
        );


        $newObj = array('$set' => array(
            $this->options->getDataField() =>  json_encode($_SESSION),
            $this->options->getLifetimeField() => new \MongoDate(time() + $this->lifetime),
            $this->options->getModifiedField() => new \MongoDate(),
        ));

        $result = $this->mongoCollection->update($criteria, $newObj, $saveOptions);

        return (bool) (isset($result['ok']) ? $result['ok'] : $result);
    }

} 