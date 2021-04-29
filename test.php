<?php

declare(strict_types=1);

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Validation;

require __DIR__ . '/vendor/autoload.php';

final class BeersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('types', ChoiceType::class, [
                'multiple' => true,
                'choices' => ['ale', 'pilsener', 'stout'],
            ]);
    }
}

$validator = Validation::createValidator();
$formFactory = Forms::createFormFactoryBuilder()
    ->addExtension(new ValidatorExtension($validator))
    ->getFormFactory();

$form = $formFactory->create(BeersType::class);
$form->submit(['types' => ['wine']]);

$expectedMessage = 'This value is not valid.';

if (!$form->isValid()) {
    $actualMessage = $form->getErrors(true)[0]->getMessage();
    if ($actualMessage !== $expectedMessage) {
        echo sprintf('Received "%s" but expected "%s"' . PHP_EOL, $actualMessage, $expectedMessage);
        exit(1);
    }
    echo "Success!\n";
    return;
}
echo "Form was valid??\n";
exit(1);
