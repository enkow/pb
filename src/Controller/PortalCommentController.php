<?php
/**
 * PortalComment controller.
 */
namespace App\Controller;
use App\Entity\PortalComment;
use App\Repository\PortalCommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
/**
 * Class PortalCommentController.
 *
 * @Route("/portalcomment")
 */
class PortalCommentController extends AbstractController
{
    /**
     * Index action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Repository\PortalCommentRepository $repository Repository
     * @param \Knp\Component\Pager\PaginatorInterface $paginator Paginator
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     name="comment_index",
     * )
     */
    public function index(Request $request, PortalCommentRepository $repository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $repository->queryAll(),
            $request->query->getInt('page', 1),
            PortalComment::NUMBER_OF_ITEMS
        );
        return $this->render(
            'comment/index.html.twig',
            ['pagination' => $pagination]
        );
    }
    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Entity\PortalComment                 $portalComment  PortalComment  entity
     * @param \App\Repository\PortalCommentRepository       $repository PortalComment repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/edit",
     *     methods={"GET", "PUT"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="comment_edit",
     * )
     */
    public function edit(Request $request, PortalComment $portalComment, PortalCommentRepository $repository): Response
    {
        $form = $this->createForm(PortalCommentType::class, $portalComment, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($portalComment);

            $this->addFlash('success', 'message.updated_successfully');

            return $this->redirectToRoute('comment_index');
        }

        return $this->render(
            'comment/edit.html.twig',
            [
                'form' => $form->createView(),
                'post' => $portalComment,
            ]
        );
    }
    /**
     * New action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Repository\PortalCommentRepository     $repository PortalComment repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/new",
     *     methods={"GET", "POST"},
     *     name="comment_new",
     * )
     */
    public function new(Request $request, PortalCommentRepository $repository): Response
    {
        $portalComment = new PortalComment();
        $form = $this->createForm(PortalCommentType::class, $portalComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($portalComment);

            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('comment_index');
        }

        return $this->render(
            'comment/new.html.twig',
            ['form' => $form->createView()]
        );
    }
    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Entity\PortalComment                      $portalComment   PortalComment entity
     * @param \App\Repository\PortalCommentRepository      $repository PortalComment repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/delete",
     *     methods={"GET", "DELETE"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="comment_delete",
     * )
     */
    public function delete(Request $request, PortalComment $portalComment, PortalCommentRepository $repository): Response
    {
        $form = $this->createForm(FormType::class, $portalComment, ['method' => 'DELETE']);
        $form->handleRequest($request);

        if ($request->isMethod('DELETE') && !$form->isSubmitted()) {
            $form->submit($request->request->get($form->getName()));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->delete($portalComment);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('comment_index');
        }

        return $this->render(
            'comment/delete.html.twig',
            [
                'form' => $form->createView(),
                'comment' => $portalComment,
            ]
        );
    }
}
