<?php

namespace App\Controller\Admin\User;

use App\Entity\User;
use App\Enum\ResponseCodeEnum;
use App\UseCase\User\DeleteUserUseCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteUserController
 * @package App\Controller\SuperAdmin\User
 */
class DeleteUserController extends AbstractController
{
    /**
     * @Route("/{user}/delete", name="app_admin_delete")
     * @Entity("user", expr="repository.getById(user)")
     *
     * @param User $user
     *
     * @param DeleteUserUseCase $useCase
     * @return JsonResponse
     */
    public function deleteAction(User $user, DeleteUserUseCase $useCase): JsonResponse
    {
        $useCase->delete($user);

        return new JsonResponse([], ResponseCodeEnum::RESPONSE_OK);
    }
}
