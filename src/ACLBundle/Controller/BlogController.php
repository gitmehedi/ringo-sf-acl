<?php
namespace ACLBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

class BlogController extends Controller
{
    // ...

    public function addCommentAction()
    {
//        $comment = new Comment();

        // ... setup $form, and submit data

//        if ($form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($comment);
//            $entityManager->flush();

            // creating the ACL
            $aclProvider = $this->get('security.acl.provider');
        echo "<pre>"; print_r($aclProvider); die();
            $objectIdentity = ObjectIdentity::fromDomainObject($comment);
            $acl = $aclProvider->createAcl($objectIdentity);

            // retrieving the security identity of the currently logged-in user
            $securityContext = $this->get('security.context');
            $user = $securityContext->getToken()->getUser();
            $securityIdentity = UserSecurityIdentity::fromAccount($user);

            // grant owner access
            $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
            $aclProvider->updateAcl($acl);
//        }
    }
}