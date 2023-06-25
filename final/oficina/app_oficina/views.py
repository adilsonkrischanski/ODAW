from django.shortcuts import render

from .models import cliente

# Create your views here.

def home(request):
    return render(request, "pages/home.html")

def cad_cliente(request):
    return render(request, "clients/cadastro.html")

def cad_veiculo(request):
    return render(request, "veiculos/cadastro.html")

def cad_manutencao(request):
    return render(request, "manutencao/cadastro.html")


def c_cliente(request):
    New_cliente = cliente()
   
    New_cliente.name = request.POST.get('name')
    New_cliente.cpf = request.POST.get('cpf')
    New_cliente.email = request.POST.get('email')
    New_cliente.phone = request.POST.get('phone')
    New_cliente.street = request.POST.get('street')
    New_cliente.cep = request.POST.get('cep')
    New_cliente.number = request.POST.get('number')
    New_cliente.apartment = request.POST.get('apartment')

    New_cliente.save()

    return render(request, "pages/home.html")



    
