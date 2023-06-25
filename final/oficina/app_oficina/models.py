from django.db import models

# Create your models here.

class cliente(models.Model):
    cpf = models.CharField(max_length=14, primary_key=True)
    name = models.CharField(max_length=100)
    email = models.EmailField()
    phone = models.CharField(max_length=20, blank=True)
    street = models.CharField(max_length=100)
    cep = models.CharField(max_length=10)
    number = models.IntegerField()
    apartment = models.CharField(max_length=10, blank=True)