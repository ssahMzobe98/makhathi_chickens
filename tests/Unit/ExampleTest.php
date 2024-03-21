<?php
use PHPUnit\Framework\TestCase;
use Mmshightech\mmshightech;
use Classes\response\Response;
use Mmshightech\service\factory\daoFactory\DaoFactory;
use Src\constants\DaoClassConstants;

class ExampleTest extends TestCase {
    protected $dbMock;
    /** NEED TO TEST AND VERYFIE THAT THIS WORKS. */
    protected function setUp(): void {
        parent::setUp();
        $this->userPdo = DaoFactory::make(DaoClassConstants::USER, [null]);
        $this->dbMock = $this->getMockBuilder(PDO::class) // Using PDO class for mocking
                             ->disableOriginalConstructor()
                             ->getMock();
    }

    public function testUpdateUserNameSuccess() {
        $userId = 1;
        $newUserName = "New Name";
        $returnData = (new Response())->successSetter()->messagerSetter('SUCCESS')->setObjectReturn();
        $stmtMock = $this->getMockBuilder(PDOStatement::class)
                         ->getMock();
        $stmtMock->expects($this->once())
                 ->method('execute')
                 ->with([$newUserName, $userId])
                 ->willReturn(true);

        $this->dbMock->expects($this->once())
                     ->method('prepare')
                     ->willReturn($stmtMock);

        $user = new User($this->dbMock);
        $result = $user->updateUserName($newUserName, $userId);
        $this->assertEquals($returnData, $result);
    }

    public function testUpdateUserNameFailed() {
        $userId = 1;
        $newUserName = "New Name";
        $returnData = (new Response())->failureSetter()->messagerSetter("Failed to process due to Specified error ")->messagerArraySetter(['error' => 'Error Description', 'Error_list' => ['list of all errors']]);
        $stmtMock = $this->getMockBuilder(PDOStatement::class)
                         ->getMock();
        $stmtMock->expects($this->once())
                 ->method('execute')
                 ->with([$newUserName, $userId])
                 ->willReturn(false);

        $this->dbMock->expects($this->once())
                     ->method('prepare')
                     ->willReturn($stmtMock);

        $user = new User($this->dbMock);
        $result = $user->updateUserName($newUserName, $userId);
        $this->assertEquals($returnData, $result);
    }

    public function testGetUserNameSuccess() {
        $userId = 1;
        $userName = "TestUser";
        $returnData = ['name' => $userName];
        
        $stmtMock = $this->getMockBuilder(PDOStatement::class)
                         ->getMock();
        $stmtMock->expects($this->once())
                 ->method('fetch')
                 ->willReturn($returnData);

        $this->dbMock->expects($this->once())
                     ->method('prepare')
                     ->willReturn($stmtMock);

        $user = new User($this->dbMock);
        $result = $user->getUserName($userId);
        $this->assertEquals($returnData, $result);
    }
}
