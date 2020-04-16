<?php
namespace UniversalEducation\Test\Unit\Api;
use UniversalEducation\Api\Client;
use UniversalEducation\Api\Connection;
use PHPUnit\Framework\TestCase;
class ClientTest extends TestCase
{
    /**
     * @var Connection|\PHPUnit_Framework_MockObject_MockObject
     */
    private $message_thread_id = 3;#6;
    private $course_id = 27;#7;
    private $lesson_id = 50;#27
    private $email = 'test@qq.com';
    private $class_token = 'feed0480-9013-42e9-afe6-399d3ec246b6';#'7ef020fc-4014-4b93-aaba-eb1b12283340';
    private $connection;
    private $basePath = '/remote_api';
    public function setUp()
    {
        $methods = array(
            'useXml',
            'failOnError',
            'authenticate',
            'setTimeout',
            'useProxy',
            'verifyPeer',
            'addHeader',
            'getLastError',
            'get',
            'post',
            'post_form',
            'head',
            'put',
            'delete',
            'getStatus',
            'getStatusMessage',
            'getBody',
            'getHeader',
            'getHeaders',
            '__destruct'
        );
        $this->basePath = $this->getStaticAttribute('UniversalEducation\\Api\\Client', 'api_path');
        $this->connection = $this->getMockBuilder('UniversalEducation\\Api\\Connection')
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();
        Client::setConnection($this->connection);
    }
    public function tearDown()
    {
        Client::configure(array('api_key' => ''));
        unset($this->connection);
    }
    public function testConfigureRequiresApiKey()
    {
        $this->expectException('\\Exception');
        $this->expectExceptionMessage("'api_key' must be provided");
        Client::configure(array());
    }
    public function testFailOnErrorPassesThroughToConnection()
    {
        $this->connection->expects($this->exactly(2))
            ->method('failOnError')
            ->withConsecutive(
                array(true),
                array(false)
            );
        Client::failOnError(true);
        Client::failOnError(false);
    }
    public function testGetLastErrorGetsErrorFromConnection()
    {
        $this->connection->expects($this->once())
            ->method('getLastError')
            ->will($this->returnValue(5));
        $this->assertSame(5, Client::getLastError());
    }
    public function testGetUser()
    {
        Client::configureBearer(array(
            'api_key' => '8KMCTZ4F7TS672DC6GRMURUC5DBREB51',
            'is_dev' => true,
        ));
        $resource = Client::getUser($this->email);
        $this->assertInstanceOf('UniversalEducation\\Api\\Resource', $resource);
    }
    public function testGetMessageThreads()
    {
        Client::configureBearer(array(
            'api_key' => '8KMCTZ4F7TS672DC6GRMURUC5DBREB51',
            'is_dev' => true,
        ));
        $collection = Client::getMessageThreads($this->email);
        foreach ($collection as $resource) {
            $this->assertInstanceOf('UniversalEducation\\Api\\Resource', $resource);
        }
    }
    public function testCreateResourcePostsToTheRightPlace()
    {
        $file_data = array( "email-logo.png" => 'email-logo.png');
        $new = array("message" => "hello");
        $this->connection->expects($this->once())
            ->method('post_form')
            ->with($this->basePath . '/messages/' . $this->message_thread_id, (object)$new, array('file_attach'=>$file_data))
            ->will($this->returnValue($new));
        Client::configureBearer(array(
           'api_key' => '8KMCTZ4F7TS672DC6GRMURUC5DBREB51',
        ));
        Client::setConnection($this->connection); // re-set the connection since Client::configure unsets it
        $result = Client::createMessage($this->message_thread_id, $this->email, $new, $file_data);
        $this->assertSame($new, $result);
    }
    public function testUpdateUser()
    {
        Client::configureBearer(array(
            'api_key' => '8KMCTZ4F7TS672DC6GRMURUC5DBREB51',
            'is_dev' => true,
        ));
        $new = (object) array(
            "email" => "test@qq.com",
            "time_zone" => "US/Pacific"
        );
        $this->connection->expects($this->once())
            ->method('put')
            ->with($this->basePath . '/user', (object)$new)
            ->will($this->returnValue($new));
        Client::configureBearer(array(
           'api_key' => '8KMCTZ4F7TS672DC6GRMURUC5DBREB51',
        ));
        Client::setConnection($this->connection); // re-set the connection since Client::configure unsets it
        $result = Client::updateUser($new);
        $this->assertSame($new, $result);
    }
    public function testGetMessageThread()
    {
        Client::configureBearer(array(
            'api_key' => '8KMCTZ4F7TS672DC6GRMURUC5DBREB51',
            'is_dev' => true,
        ));
        $resource = Client::getMessageThread($this->message_thread_id, $this->email);
        $this->assertInstanceOf('UniversalEducation\\Api\\Resource', $resource);
    }
    public function testGetUnreadCount()
    {
        Client::configureBearer(array(
            'api_key' => '8KMCTZ4F7TS672DC6GRMURUC5DBREB51',
            'is_dev' => true,
        ));
        $result = Client::getUnreadCount($this->email);
        $this->assertIsInt($result);
    }
    public function testGetNotifyCount()
    {
        Client::configureBearer(array(
            'api_key' => '8KMCTZ4F7TS672DC6GRMURUC5DBREB51',
            'is_dev' => true,
        ));
        $result = Client::getNotifyCount($this->email);
        $this->assertIsInt($result);
    }
    public function testGetCourses()
    {
        Client::configureBearer(array(
            'api_key' => '8KMCTZ4F7TS672DC6GRMURUC5DBREB51',
            'is_dev' => true,
        ));
        $collection = Client::getCourses($this->email);
        foreach ($collection as $resource) {
            $this->assertInstanceOf('UniversalEducation\\Api\\Resource', $resource);
        }
    }
    public function testGetLessons()
    {
        Client::configureBearer(array(
            'api_key' => '8KMCTZ4F7TS672DC6GRMURUC5DBREB51',
            'is_dev' => true,
        ));
        $collection = Client::getLessons($this->course_id, $this->email);
        foreach ($collection as $resource) {
            $this->assertInstanceOf('UniversalEducation\\Api\\Resource', $resource);
        }
    }
    public function testGetLesson()
    {
        Client::configureBearer(array(
            'api_key' => '8KMCTZ4F7TS672DC6GRMURUC5DBREB51',
            'is_dev' => true,
        ));
        $resource = Client::getLesson($this->course_id, $this->lesson_id, $this->email);
        $this->assertInstanceOf('UniversalEducation\\Api\\Resource', $resource);
    }
    public function testGetGrades()
    {
        Client::configureBearer(array(
            'api_key' => '8KMCTZ4F7TS672DC6GRMURUC5DBREB51',
            'is_dev' => true,
        ));
        $resource = Client::getGrades($this->course_id, $this->email);
        $this->assertInstanceOf('UniversalEducation\\Api\\Resource', $resource);
    }
    public function testGetClasses()
    {
        Client::configureBearer(array(
            'api_key' => '8KMCTZ4F7TS672DC6GRMURUC5DBREB51',
            'is_dev' => true,
        ));
        $collection = Client::getClasses($this->email);
        $this->assertIsArray($collection);
        foreach ($collection as $resource) {
            $this->assertInstanceOf('UniversalEducation\\Api\\Resource', $resource);
        }
    }
    public function getGroupClasses()
    {
        Client::configureBearer(array(
            'api_key' => '8KMCTZ4F7TS672DC6GRMURUC5DBREB51',
            'is_dev' => true,
        ));
        $collection = Client::getGroupClasses($this->email);
        foreach ($collection as $resource) {
            $this->assertInstanceOf('UniversalEducation\\Api\\Resource', $resource);
        }
    }
    public function testGetClassDetails()
    {
        Client::configureBearer(array(
            'api_key' => '8KMCTZ4F7TS672DC6GRMURUC5DBREB51',
            'is_dev' => true,
        ));
        $resource = Client::getClassDetails($this->class_token, $this->email);
        $this->assertInstanceOf('UniversalEducation\\Api\\Resource', $resource);
    }
    public function testCreateUser()
    {
        $new = array(
            "email" => "JohnDoe@example.com",
            "first_name" => "John",
            "last_name" => "Doe",
            "password" => "password",
        );
        $this->connection->expects($this->once())
            ->method('post')
            ->with($this->basePath . '/user/create', (object)$new)
            ->will($this->returnValue($new));
        Client::configureBearer(array(
           'api_key' => '8KMCTZ4F7TS672DC6GRMURUC5DBREB51',
        ));
        Client::setConnection($this->connection); // re-set the connection since Client::configure unsets it
        $result = Client::createUser($new);
        $this->assertSame($new, $result);
    }
    public function testCreateHomework()
    {
        $file_data = array(
            "d55d15e0-5259-42bf-a372-b00c0fb96bf4.png" => 'email-logo.png',
            "test.png" => 'email-logo.png',
        );
        $new = array();
        Client::configureBearer(array(
           'api_key' => '8KMCTZ4F7TS672DC6GRMURUC5DBREB51',
        ));
        $this->connection->expects($this->once())
            ->method('post_form')
            ->with($this->basePath . '/courses'. '/' . $this->course_id . '/' . $this->lesson_id, (object)$new, array('homework'=>$file_data))
            ->will($this->returnValue($new));
        Client::setConnection($this->connection); // re-set the connection since Client::configure unsets it
        $result = Client::createHomework($this->course_id, $this->lesson_id, $this->email, $file_data);
        $this->assertSame($new, $result);
    }
}