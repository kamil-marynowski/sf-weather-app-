<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\WeatherForecastSlot;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeatherForecastSlotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_id', ChoiceType::class, [
                'choices' => [
                    'Daily' => \App\Enum\WeatherForecastSlotType::DAILY->value,
                    'Part of day' => \App\Enum\WeatherForecastSlotType::DAY_PARTLY->value,
                    'Hourly' => \App\Enum\WeatherForecastSlotType::HOURLY->value,
                ]
            ])
            ->add('datetime', DateTimeType::class, [
                'date_label' => 'Datetime for weather forecast slot',
            ])
            ->add('icon_class', TextType::class)
            ->add('temperature', NumberType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WeatherForecastSlot::class,
        ]);
    }
}
