<?php

namespace AppBundle\Forms;

use AppBundle\Models\Import;
use AppBundle\Repository\DistributorRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImportType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('distributor', EntityType::class, ['class' => 'AppBundle:Distributor', 'choice_label' => 'name', 'placeholder' => '---'])
			->add('file', FileType::class)
			->add('replace', CheckboxType::class, [
				'required' => false,
			]);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver
			->setDefaults([
				'data_class' => Import::class,
				'distributors' => null
			])
			->setRequired(
				'distributors'
			);
	}
}