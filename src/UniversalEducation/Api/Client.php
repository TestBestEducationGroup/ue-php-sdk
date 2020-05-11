<?php

namespace UniversalEducation\Api;

use \Exception as Exception;

/**
 *  Universal Education API Client
 */
class Client
{

    /**
     * API key
     *
     * @var string
     */
    private static $api_key;

    /**
     * API path prefix to be added to store URL for requests
     *
     * @var string
     */
    private static $path_prefix = '/remote_api';

    /**
     * Connection instance
     *
     * @var Connection
     */
    private static $connection;
    /**
     * Resource class name
     *
     * @var string
     */
    private static $resource;

    /**
     * Full URL path to the configured store API.
     *
     * @var string
     */
    private static $dev_api_url = 'https://dev.ue-learn.com';
    private static $live_api_url = 'https://login.ue-learn.com';
    private static $cn_api_url = 'https://login.ue-learn.cn';
    public static $api_path;

    /**
     * Configure the API client with the required settings to access
     * the API for a store.
     *
     * Accepts OAuth and (for now!) Basic Auth credentials
     *
     * @param array $settings
     */
    public static function configure($settings)
    {
        self::configureBearer($settings);
    }

    /**
     * Configure the API client with the required OAuth credentials.
     *
     * Requires a settings array to be passed in with the following keys:
     *
     * - client_id
     * - auth_token
     * - store_hash
     *
     * @param array $settings
     * @throws \Exception
     */
    public static function configureBearer($settings)
    {
        if (!isset($settings['api_key'])) {
            throw new Exception("'api_key' must be provided");
        }
        if (isset($settings['is_dev']) && $settings['is_dev']) {
            self::$api_path = self::$dev_api_url . self::$path_prefix;
        } else if (isset($settings['is_cn']) && $settings['is_cn']) {
            self::$api_path = self::$cn_api_url . self::$path_prefix;
        } else {
            self::$api_path = self::$live_api_url . self::$path_prefix;
        }
        self::$api_key = $settings['api_key'];
        self::$connection = false;
    }

    /**
     * Configure the API client to throw exceptions when HTTP errors occur.
     *
     * Note that network faults will always cause an exception to be thrown.
     *
     * @param bool $option sets the value of this flag
     */
    public static function failOnError($option = true)
    {
        self::connection()->failOnError($option);
    }
    /**
     * Switch SSL certificate verification on requests.
     *
     * @param bool $option sets the value of this flag
     */
    public static function verifyPeer($option = false)
    {
        self::connection()->verifyPeer($option);
    }
    /**
     * Connect to the internet through a proxy server.
     *
     * @param string $host host server
     * @param int|bool $port port number to use, or false
     */
    public static function useProxy($host, $port = false)
    {
        self::connection()->useProxy($host, $port);
    }
    /**
     * Get error message returned from the last API request if
     * failOnError is false (default).
     *
     * @return string
     */
    public static function getLastError()
    {
        return self::connection()->getLastError();
    }
    /**
     * Get an instance of the HTTP connection object. Initializes
     * the connection if it is not already active.
     *
     * @return Connection
     */
    private static function connection()
    {
        if (!self::$connection) {
            self::$connection = new Connection();
            self::$connection->authenticateBearer(self::$api_key);
        }
        return self::$connection;
    }
    /**
     * Convenience method to return instance of the connection
     *
     * @return Connection
     */
    public static function getConnection()
    {
        return self::connection();
    }
    /**
     * Set the HTTP connection object. DANGER: This can screw up your Client!
     *
     * @param Connection $connection The connection to use
     */
    public static function setConnection(Connection $connection = null)
    {
        self::$connection = $connection;
    }
    /**
     * Get a collection result from the specified endpoint.
     *
     * @param string $path api endpoint
     * @param string $resource resource class to map individual items
     * @return mixed array|string mapped collection or XML string if useXml is true
     */
    public static function getCollection($path, $email, $resource = 'Resource')
    {
        self::connection()->addHeader('X-BEHALF-KEY', $email);
        $response = self::connection()->get(self::$api_path . $path);
        return self::mapCollection($resource, $response);
    }
    /**
     * Get a resource entity from the specified endpoint.
     *
     * @param string $path api endpoint
     * @param string $resource resource class to map individual items
     * @param string $email user email we are requesting for
     * @return mixed Resource|string resource object or XML string if useXml is true
     */
    public static function getResource($path, $email, $resource = 'Resource')
    {
        self::connection()->addHeader('X-BEHALF-KEY', $email);
        $response = self::connection()->get(self::$api_path . $path);
        return self::mapResource($resource, $response);
    }
    /**
     * Get a count value from the specified endpoint.
     *
     * @param string $path api endpoint
     * @return mixed int|string count value or XML string if useXml is true
     */
    public static function getCount($path)
    {
        $response = self::connection()->get(self::$api_path . $path);
        if (!$response || is_string($response)) {
            return $response;
        }
        return $response->count;
    }
    /**
     * Send a post request to create a resource on the specified collection.
     *
     * @param string $path api endpoint
     * @param mixed $object object or XML string to create
     * @return mixed
     */
    public static function createResource($path, $object, $email)
    {
        if (is_array($object)) {
            $object = (object)$object;
        }
        self::connection()->addHeader('X-BEHALF-KEY', $email);
        return self::connection()->post(self::$api_path . $path, $object);
    }
    /**
     * Send a post request to create a resource on the specified collection.
     *
     * @param string $path api endpoint
     * @param mixed $object object or XML string to create
     * @return mixed
     */
    public static function createFiledResource($path, $object, $email, $files)
    {
        if (is_array($object)) {
            $object = (object)$object;
        }
        self::connection()->addHeader('X-BEHALF-KEY', $email);
        return self::connection()->post_form(self::$api_path . $path, $object, $files);
    }
    /**
     * Send a put request to update the specified resource.
     *
     * @param string $path api endpoint
     * @param mixed $object object or XML string to update
     * @return mixed
     */
    public static function updateResource($path, $object, $email)
    {
        if (is_array($object)) {
            $object = (object)$object;
        }
        self::connection()->addHeader('X-BEHALF-KEY', $email);
        return self::connection()->put(self::$api_path . $path, $object);
    }
    /**
     * Send a delete request to remove the specified resource.
     *
     * @param string $path api endpoint
     * @return mixed
     */
    public static function deleteResource($path, $email)
    {
        self::connection()->addHeader('X-BEHALF-KEY', $email);
        return self::connection()->delete(self::$api_path . $path);
    }
    /**
     * Internal method to wrap items in a collection to resource classes.
     *
     * @param string $resource name of the resource class
     * @param array $object object collection
     * @return array
     */
    private static function mapCollection($resource, $object)
    {
        if (!$object || is_string($object)) {
            return $object;
        }
        $baseResource = __NAMESPACE__ . '\\' . $resource;
        self::$resource = (class_exists($baseResource)) ? $baseResource : 'UniversalEducation\\Api\\Resources\\' . $resource;
        return array_map(array('self', 'mapCollectionObject'), $object);
    }
    /**
     * Callback for mapping collection objects resource classes.
     *
     * @param \stdClass $object
     * @return Resource
     */
    private static function mapCollectionObject($object)
    {
        $class = self::$resource;
        return new $class($object);
    }
    /**
     * Map a single object to a resource class.
     *
     * @param string $resource name of the resource class
     * @param \stdClass $object
     * @return Resource
     */
    private static function mapResource($resource, $object)
    {
        if (!$object || is_string($object)) {
            return $object;
        }
        $baseResource = __NAMESPACE__ . '\\' . $resource;
        $class = (class_exists($baseResource)) ? $baseResource : 'UniversalEducation\\Api\\Resources\\' . $resource;
        return new $class($object);
    }
    /**
     * Map object representing a count to an integer value.
     *
     * @param \stdClass $object
     * @return int
     */
    private static function mapCount($object)
    {
        if (!$object || is_string($object)) {
            return $object;
        }
        return $object->count;
    }

    /**
     * Return the message threads for a user
     *
     * @param int $email email for the user
     * @return mixed
     */
    public static function getUser($email)
    {
        return self::getResource('/user', $email, 'User');
    }

    /**
     * Return the message threads for a user
     *
     * @param string $email email for the user
     * @return mixed
     */
    public static function getMessageThreads($email)
    {
        return self::getCollection('/messages', $email, 'MessageThread');
    }

    /**
     * Return the message threads for a user
     *
     * @param int $id id of the message thread we are looking for
     * @param string $email email for the user
     * @return mixed
     */
    public static function getMessageThread($id, $email)
    {
        return self::getResource('/messages' . '/' . $id, $email, 'MessageThread');
    }
    /**
     * Create a new Message.
     *
     * @param int $id message thread the message is to be applied to
     * @param string $email email of user
     * @param mixed $object fields to create
     * @return mixed
     */
    public static function createMessage($id, $email, $object, $files = NULL)
    {
        if ($files) {
            return self::createFiledResource('/messages' . '/' . $id, $object, $email, array('file_attach' => $files));
        } else {
            return self::createResource('/messages' . '/' . $id, $object, $email);
        }
    }

    /**
     * Get unread Message Count.
     *
     * @param string $email email of user
     * @return int
     */
    public static function getUnreadCount($email)
    {
        return self::getResource('/messages/unread', $email, 'MessageCount')->unread;
    }


    /**
     * Get notified Message Count.
     *
     * @param string $email email of user
     * @return int
     */
    public static function getNotifyCount($email)
    {
        return self::getResource('/messages/notify', $email, 'MessageCount')->unread;
    }

    /**
     * Return the message threads for a user
     *
     * @param int $id id of the course
     * @param string $email email for the user
     * @return mixed
     */
    public static function getCourses($email)
    {
        return self::getCollection('/courses', $email, 'CourseSession');
    }

    /**
     * Return the message threads for a user
     *
     * @param int $id id of the course
     * @param string $email email for the user
     * @return mixed
     */
    public static function getLessons($id, $email)
    {
        return self::getCollection('/courses' . '/' . $id, $email, 'Lesson');
    }

    /**
     * Return the message threads for a user
     *
     * @param int $id id of the course
     * @param string $email email for the user
     * @return mixed
     */
    public static function getLesson($course_id, $lesson_id, $email)
    {
        return self::getResource('/courses' . '/' . $course_id . "/" . $lesson_id, $email, 'Lesson');
    }

    /**
     * Return the message threads for a user
     *
     * @param int $id id of the course
     * @param string $email email for the user
     * @return mixed
     */
    public static function getGrades($id, $email)
    {
        return self::getResource('/courses/grades/' . $id, $email, 'Grades');
    }

    /**
     * Return the message threads for a user
     *
     * @param string $email email for the user
     * @return mixed
     */
    public static function getClasses($email)
    {
        return self::getCollection('/classes/list', $email, 'Classes');
    }
    /**
     * Return the message threads for a user
     *
     * @param string $email email for the user
     * @return mixed
     */
    public static function getGroupClasses($email)
    {
        return self::getCollection('/classes/group', $email, 'Classes');
    }
    /**
     * Return the message threads for a user
     *
     * @param string $email email for the user
     * @return mixed
     */
    public static function getClassDetails($token, $email)
    {
        return self::getResource('/classes' . '/'. $token, $email, 'Classes');
    }
    /**
     * Creates a user
     *
     * @param mixed $object user object
     * @return mixed
     */
    public static function createUser($object)
    {
        return self::createResource('/user/create', $object, $object['email']);
    }
    /**
     * Creates a user
     *
     * @param mixed $object user object
     * @return mixed
     */
    public static function updateUser($object)
    {
        return self::updateResource('/user', $object, $object->email);
    }
    /**
     * Creates a user
     *
     * @param int $course_id id of the course
     * @param int $lesson_id id of the lesson
     * @param string $email email of the user
     * @param mixed $object homework object
     * @param array $files array of filename=>filedata
     * 
     * @return mixed
     */
    public static function createHomework($course_id, $lesson_id, $email, $files)
    {
        return self::createFiledResource('/courses' . '/' . $course_id . '/' . $lesson_id, array(), $email, array('homework' => $files));
    }
}
