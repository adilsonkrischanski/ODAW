from django.shortcuts import render, redirect

from .models import Cliente
from .models import Veiculo
from .models import Mecanico
from .models import Manutencao
from .models import Peca


def home(request):
    return render(request, "pages/home.html")

def cad_cliente(request):
    return render(request, "clients/cadastro.html")

def cad_veiculo(request):
    return render(request, "veiculos/cadastro.html")

def cad_manutencao(request):
    return render(request, "manutencao/cadastro.html")

def cad_mecanico(request):
    return render(request, "mechanical/cadastro.html")


def c_cliente(request):
    if request.method == 'POST':
        New_cliente = Cliente()
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

def c_veiculo(request):
    if request.method == 'POST':
        new_veiculo = Veiculo(
            owner=request.POST.get('owner'),
            manufacturer=request.POST.get('manufacturer'),
            model=request.POST.get('model'),
            year=request.POST.get('year'),
            mileage=request.POST.get('mileage'),
            color=request.POST.get('color'),
            fuel=request.POST.get('fuel'),
            transmission=request.POST.get('transmission'),
            license_plate=request.POST.get('license_plate')
        )
        new_veiculo.save()

        return render(request, 'pages/home.html')

def c_mecanico(request):
    if request.method == 'POST':
        new_mecanico = Mecanico()
        new_mecanico.name = request.POST.get('name')
        new_mecanico.cpf = request.POST.get('cpf')
        new_mecanico.email = request.POST.get('email')
        new_mecanico.phone = request.POST.get('phone')
        new_mecanico.street = request.POST.get('street')
        new_mecanico.cep = request.POST.get('cep')
        new_mecanico.number = request.POST.get('number')
        new_mecanico.apartment = request.POST.get('apartment')
        new_mecanico.salary = request.POST.get('salary')
        new_mecanico.workhours = request.POST.get('workhours')
        new_mecanico.specialty = request.POST.get('specialty')

        new_mecanico.save()
        return render(request, 'pages/home.html')


def c_manutencao(request):
    if request.method == 'POST':
        # Extrair os dados do formulário
        vehicle = request.POST.get('vehicle')
        Km = request.POST.get('Km')
        mechanic = request.POST.get('mechanic')
        date = request.POST.get('date')
        comments = request.POST.get('comments')

        # Criar uma instância de Manutencao
        manutencao = Manutencao(
            vehicle=vehicle,
            Km=Km,
            mechanic=mechanic,
            date=date,
            comments=comments
        )

        # Salvar a instância de Manutencao no banco de dados
        manutencao.save()
        

        # Processar as peças adicionadas
        part_names = request.POST.getlist('part')
        quantities = request.POST.getlist('quantity')
        prices = request.POST.getlist('unitPrice')
        

        for i in range(len(part_names)):
            nome = part_names[i]
            quantidade = quantities[i]
            preco_unitario = prices[i]

            if quantidade:
                # Criar uma instância de Peca associada à Manutencao
                peca = Peca(
                    manutencao=manutencao,
                    nome=nome,
                    quantidade=int(quantidade),  # Converter para número inteiro
                    preco_unitario=preco_unitario
                )

                # Salvar a instância de Peca no banco de dados
                peca.save()
            

    

        return render(request, 'pages/home.html')

def filter_cliente_veiculo(request):
        return render(request, 'veiculos/forum.html')


def forum_veiculo_propietario(request):
    if request.method == 'POST':
        name = request.POST.get('name') 
        print(name)

        veiculos = Veiculo.objects.filter(owner=name)
        return render(request, 'veiculos/table.html', {'veiculos': veiculos})
    




def filter_manutencao_veiculo(request):
        return render(request, 'manutencao/forum_veiculo.html')

def forum_manutencao_veiculo(request):
    if request.method == 'POST':
        name = request.POST.get('name')
        manutencoes = Manutencao.objects.filter(vehicle=name)
        man = []
        for manutencao in manutencoes:
            pecas = Peca.objects.filter(manutencao=manutencao)
            manutencao_com_pecas = {
                'manutencao': manutencao,
                'pecas': pecas
            }
            man.append(manutencao_com_pecas)

        print(man)
    
        return render(request, 'manutencao/show_manutencoes.html', {'manutencoes': man})


def filter_manutencao_mecanico(request):
        return render(request, 'manutencao/forum_mecanico.html')

def forum_manutencao_mecanico(request):
       if request.method == 'POST':
        name = request.POST.get('name')
        manutencoes = Manutencao.objects.filter(mechanic=name)
        man = []
        for manutencao in manutencoes:
            pecas = Peca.objects.filter(manutencao=manutencao)
            manutencao_com_pecas = {
                'manutencao': manutencao,
                'pecas': pecas
            }
            man.append(manutencao_com_pecas)


        print(manutencoes)
    
        return render(request, 'manutencao/show_manutencoes.html', {'manutencoes': man})

 

def clearDataBase(self, request):
    # Excluir todos os registros da tabela Peca
    Peca.objects.all().delete()

    # Excluir todos os registros da tabela Manutencao
    Manutencao.objects.all().delete()

    # Excluir todos os registros da tabela Veiculo
    Veiculo.objects.all().delete()

    # Excluir todos os registros da tabela Mecanico
    Mecanico.objects.all().delete()

    # Excluir todos os registros da tabela Cliente
    Cliente.objects.all().delete()

    return render(request, 'pages/home.html')





    