<?php
/**
 * PortalPhoto controller.
 */
namespace App\Controller;
use App\Entity\PortalPhoto;
use App\Repository\PortalPhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
/**
 * Class PortalPhotoController.
 *
 * @Route("/portalphoto")
 */
class PortalPhotoController extends AbstractController
{
    /**
     * Index action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Repository\PortalPhotoRepository $repository Repository
     * @param \Knp\Component\Pager\PaginatorInterface $paginator Paginator
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     name="photo_index",
     * )
     */
    public function index(Request $request, PortalPhotoRepository $repository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $repository->queryAll(),
            $request->query->getInt('page', 1),
            PortalPhoto::NUMBER_OF_ITEMS
        );
        return $this->render(
            'user/index.html.twig',
            ['pagination' => $pagination]
        );
    }
    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Entity\PortalPhoto                  $portalPhoto  PortalPhoto  entity
     * @param \App\Repository\PortalPhotoRepository       $repository PortalPhoto repository
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
     *     name="photo_edit",
     * )
     */
    public function edit(Request $request, PortalPhoto $portalPhoto, PortalPhotoRepository $repository): Response
    {
        $form = $this->createForm(PortalPhotoType::class, $portalPhoto, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($portalPhoto);

            $this->addFlash('success', 'message.updated_successfully');

            return $this->redirectToRoute('photo_index');
        }

        return $this->render(
            'photo/edit.html.twig',
            [
                'form' => $form->createView(),
                'photo' => $portalPhoto,
            ]
        );
    }
    /**
     * New action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Repository\PortalPhotoRepository      $repository PortalPhoto repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/new",
     *     methods={"GET", "POST"},
     *     name="photo_new",
     * )
     */
    public function new(Request $request, PortalPhotoRepository $repository): Response
    {
        $portalPhoto = new PortalPhoto();
        $form = $this->createForm(PortalPhotoType::class, $portalPhoto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($portalPhoto);

            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('photo_index');
        }

        return $this->render(
            'photo/new.html.twig',
            ['form' => $form->createView()]
        );
    }
    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP request
     * @param \App\Entity\PortalPhoto                    $portalPhoto   PortalPhoto entity
     * @param \App\Repository\PortalPhotoRepository      $repository PortalPhoto repository
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
     *     name="photo_delete",
     * )
     */
    public function delete(Request $request, PortalPhoto $portalPhoto, PortalPhotoRepository $repository): Response
    {
        $form = $this->createForm(FormType::class, $portalPhoto, ['method' => 'DELETE']);
        $form->handleRequest($request);

        if ($request->isMethod('DELETE') && !$form->isSubmitted()) {
            $form->submit($request->request->get($form->getName()));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->delete($portalPhoto);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('photo_index');
        }

        return $this->render(
            'photo/delete.html.twig',
            [
                'form' => $form->createView(),
                'photo' => $portalPhoto,
            ]
        );
    }

}
