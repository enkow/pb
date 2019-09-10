<?php
/**
 * PortalPost type.
 */

namespace App\Form;

use App\Entity\PortalUser;
use Symfony\Bridge\Doctrine\Tests\Fixtures\PortalPost;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PortalPostType.
 */
class PortalPostType extends AbstractType
{
    /**
     * Builds the form.
     *
     * This method is called for each type in the hierarchy starting from the
     * top most type. Type extensions can further modify the form.
     *
     * @see FormTypeExtensionInterface::buildForm()
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array                $options The options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'posts',
            EntityType::class,
            [
                'class' => Tag::class,
                'choice_label' => function ($portalPost) {
                    return $portalPost->getTitle();
                },
                'label' => 'label.tags',
                'placeholder' => 'label.none',
                'required' => false,
                'expanded' => true,
                'multiple' => true,
            ]
        );
    }

    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => PortalPost::class]);
    }

    /**
     * Returns the prefix of the template block name for this type.
     *
     * The block prefix defaults to the underscored short class name with
     * the "Type" suffix removed (e.g. "UserProfileType" => "user_profile").
     *
     * @return string The prefix of the template block name
     */
    public function getBlockPrefix(): string
    {
        return 'post';
    }
}
