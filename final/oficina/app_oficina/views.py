from django.shortcuts import render

# Create your views here.

def home(request):
    return render(request, "pages/home.html")

def cad_cliente(request):
    return render(request, "clients/cadastro.html")

def cad_veiculo(request):
    return render(request, "veiculos/cadastro.html")
    
