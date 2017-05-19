<?php

namespace WCS\TvShowManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WCS\TvShowManagerBundle\Bundle\Form\TvShowType;
use WCS\TvShowManagerBundle\Entity\TvShow;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TvShowManagerBundle:Default:index.html.twig');
    }

  public function tvshowAction()
  {
      return $this->render('TvShowManagerBundle:Default:index.html.twig');
  }

      public function newAction()
      {
          $entity = new TvShow();
          $form   = $this->createForm(new TvShow(), $entity);

          return array(
              'entity' => $entity,
              'form'   => $form->createView()
          );
      }

      public function createAction()
      {
          $entity  = new TvShow();
          $request = $this->getRequest();
          $form    = $this->createForm(new TvShowType(), $entity);
          $form->bindRequest($request);

          if ($form->isValid()) {
              $em = $this->getDoctrine()->getManager();
              $em->persist($entity);
              $em->flush();

              return $this->redirect($this->generateUrl('url', array('id' => $entity->getId())));

          }

          return array(
              'entity' => $entity,
              'form'   => $form->createView()
          );
      }


      public function editAction($id)
      {
          $em = $this->getDoctrine()->getManager();

          $entity = $em->getRepository('TvShowManagerBundle:Tvshow')->find($id);

          if (!$entity) {
              throw $this->createNotFoundException('Pas trouvé');
          }

          $editForm = $this->createForm(new TvShowType(), $entity);
          $deleteForm = $this->createDeleteForm($id);

          return array(
              'entity'      => $entity,
              'edit_form'   => $editForm->createView(),
              'delete_form' => $deleteForm->createView(),
          );
      }

      public function updateAction($id)
      {
          $em = $this->getDoctrine()->getManager();

          $entity = $em->getRepository('TvShowManagerBundle:Tvshow')->find($id);

          if (!$entity) {
              throw $this->createNotFoundException('Pas trouvé.');
          }

          $editForm   = $this->createForm(new TvShowType(), $entity);
          $deleteForm = $this->createDeleteForm($id);

          $request = $this->getRequest();

          $editForm->bindRequest($request);

          if ($editForm->isValid()) {
              $em->persist($entity);
              $em->flush();

              return $this->redirect($this->generateUrl('edit', array('id' => $id)));
          }

          return array(
              'entity'      => $entity,
              'edit_form'   => $editForm->createView(),
              'delete_form' => $deleteForm->createView(),
          );
      }

      public function deleteAction($id)
      {
          $form = $this->createDeleteForm($id);
          $request = $this->getRequest();

          $form->bindRequest($request);

          if ($form->isValid()) {
              $em = $this->getDoctrine()->getManager();
              $entity = $em->getRepository('TvShowManagerBundle:Tvshow')->find($id);

              if (!$entity) {
                  throw $this->createNotFoundException('Pas trouvé');
              }

              $em->remove($entity);
              $em->flush();
          }

          return $this->redirect($this->generateUrl('TvShow'));
      }

      private function createDeleteForm($id)
      {
          return $this->createFormBuilder(array('id' => $id))
              ->add('id', 'hidden')
              ->getForm();
      }
}
