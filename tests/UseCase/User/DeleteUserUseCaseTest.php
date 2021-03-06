<?php

namespace App\Tests\UseCase\User;

use App\Entity\User;
use App\UseCase\User\DeleteUserUseCase;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Security;

class DeleteUserUseCaseTest extends TestCase
{

    /**
     * @var EntityManagerInterface|MockObject
     */
    private $em;

    /**
     * @var DeleteUserUseCase
     */
    private $deleteUserUseCase;

    /**
     * @var Security
     */
    private $security;

    /**
     * This method is called before each test.
     */
    protected function setUp()
    {
        $this->em = $this->createMock(EntityManagerInterface::class);
        $this->deleteUserUseCase = new DeleteUserUseCase($this->em, $this->security);
    }

    public function testDelete()
    {
        $user = (new User())->setDeleted(true);
        $this->em->expects($this->once())->method('persist')->with($user);
        $this->em->expects($this->once())->method('flush');
        $this->deleteUserUseCase->delete($user);
        $this->assertTrue($user->isDeleted());
    }
}
