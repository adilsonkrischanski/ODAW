from django.db import models



class Cliente(models.Model):
    cpf = models.CharField(max_length=14, primary_key=True)
    name = models.CharField(max_length=100, unique=True)
    email = models.EmailField()
    phone = models.CharField(max_length=20, blank=True)
    street = models.CharField(max_length=100)
    cep = models.CharField(max_length=10)
    number = models.IntegerField()
    apartment = models.CharField(max_length=10, blank=True)


class Mecanico(models.Model):
    cpf = models.CharField(max_length=14, primary_key=True)
    name = models.CharField(max_length=100,unique=True)
    email = models.EmailField()
    phone = models.CharField(max_length=20, blank=True)
    street = models.CharField(max_length=100)
    cep = models.CharField(max_length=9)
    number = models.IntegerField()
    apartment = models.CharField(max_length=100, blank=True)
    salary = models.DecimalField(max_digits=10, decimal_places=2)
    workhours = models.CharField(max_length=100)
    specialty = models.CharField(max_length=100)


class Veiculo(models.Model):
    owner = models.CharField(max_length=100)
    manufacturer = models.CharField(max_length=100)
    model = models.CharField(max_length=100)
    year = models.IntegerField()
    mileage = models.IntegerField()
    color = models.CharField(max_length=100)
    fuel = models.CharField(max_length=100)
    transmission = models.CharField(max_length=100)
    license_plate = models.CharField(max_length=20, primary_key=True)


class Manutencao(models.Model):
    vehicle = models.CharField(max_length=20)
    Km = models.IntegerField()  
    mechanic = models.CharField(max_length=100)
    date = models.DateField()
    comments = models.TextField()


class Peca(models.Model):
    manutencao = models.ForeignKey(Manutencao, on_delete=models.CASCADE, related_name='pecas')
    nome = models.CharField(max_length=100)
    quantidade = models.IntegerField()
    preco_unitario = models.DecimalField(max_digits=8, decimal_places=2)

