"""oficina URL Configuration

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/3.2/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.contrib import admin
from django.urls import path
from app_oficina import views

urlpatterns = [
    # path('admin/', admin.site.urls),
    path('', views.home, name="home"),

    path('', views.clearDataBase, name="clearDataBase"),

    path('cadastro/cliente', views.cad_cliente, name="cad_cliente"),
    path('cadastro/veiculo', views.cad_veiculo, name="cad_veiculo"),
    path('cadastro/manutencao', views.cad_manutencao, name="cad_manutencao"),
    path('cadastro/mecanico', views.cad_mecanico, name="cad_mecanico"),


    path('cadastro/cliente/concluido', views.c_cliente, name="c_cliente"),
    path('cadastro/veiculo/concluido', views.c_veiculo, name="c_veiculo"),
    path('cadastro/mecanico/concluido', views.c_mecanico, name="c_mecanico"),
    path('cadastro/manutencao/concluido', views.c_manutencao, name="c_manutencao"),

    path('filtro/cliente/', views.filter_cliente_veiculo, name="filter_cliente_veiculo"),
    path('filtro/cliente/resultado', views.forum_veiculo_propietario, name="forum_veiculo_propietario"),

    path('filtro/manutencao/veiculo', views.filter_manutencao_veiculo, name="filter_manutencao_veiculo"),
    path('filtro/manutencao/veiculo/resultado', views.forum_manutencao_veiculo, name="forum_manutencao_veiculo"),




    path('filtro/manutencao/mecanico', views.filter_manutencao_mecanico, name="filter_manutencao_mecanico"),
    path('filtro/manutencao/mecanico/resultado', views.forum_manutencao_mecanico, name="forum_manutencao_mecanico"),


    
]


