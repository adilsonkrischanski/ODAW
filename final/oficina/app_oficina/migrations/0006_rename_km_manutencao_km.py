# Generated by Django 3.2.12 on 2023-07-02 11:32

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('app_oficina', '0005_auto_20230701_2001'),
    ]

    operations = [
        migrations.RenameField(
            model_name='manutencao',
            old_name='Km',
            new_name='km',
        ),
    ]