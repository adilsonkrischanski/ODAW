import numpy as np
import matplotlib.pyplot as plt

def hermite_cubic_interp(points):
    # Verifica se há pontos suficientes para o cálculo
    if len(points) != 2:
        raise ValueError("A interpolação cúbica de Hermite requer exatamente 2 pontos.")

    # Extrai as coordenadas dos pontos
    x0, y0 = points[0]
    x1, y1 = points[1]

    # Calcula as derivadas nos pontos de controle
    dx0, dy0 = 1.5 * (x1 - x0), 1.5 * (y1 - y0)
    dx1, dy1 = dx0, dy0

    # Cria o parâmetro t
    t = np.linspace(0, 1, num=100)

    # Calcula as coordenadas x e y da curva cúbica de Hermite
    x = x0 * (2*t**3 - 3*t**2 + 1) + x1 * (-2*t**3 + 3*t**2) + dx0 * (t**3 - 2*t**2 + t) + dx1 * (t**3 - t**2)
    y = y0 * (2*t**3 - 3*t**2 + 1) + y1 * (-2*t**3 + 3*t**2) + dy0 * (t**3 - 2*t**2 + t) + dy1 * (t**3 - t**2)

    return x, y

def bezier_cubic_interp(points):
    # Verifica se há pontos suficientes para o cálculo
    if len(points) != 4:
        raise ValueError("A interpolação cúbica de Bézier requer exatamente 4 pontos.")

    # Extrai as coordenadas dos pontos
    x0, y0 = points[0]
    x1, y1 = points[1]
    x2, y2 = points[2]
    x3, y3 = points[3]

    # Cria o parâmetro t
    t = np.linspace(0, 1, num=100)

    # Calcula as coordenadas x e y da curva cúbica de Bézier
    x = (1 - t)**3 * x0 + 3 * (1 - t)**2 * t * x1 + 3 * (1 - t) * t**2 * x2 + t**3 * x3
    y = (1 - t)**3 * y0 + 3 * (1 - t)**2 * t * y1 + 3 * (1 - t) * t**2 * y2 + t**3 * y3

    return x, y

def hermite_cubic_interp_c2(points):
    # Verifica se há pontos suficientes para o cálculo
    if len(points) != 2:
        raise ValueError("A interpolação cúbica de Hermite com C2 requer exatamente 2 pontos.")

    # Extrai as coordenadas dos pontos
    x0, y0 = points[0]
    x1, y1 = points[1]

    # Calcula as derivadas nos pontos de controle
    dx0, dy0 = 0.5 * (x1 - x0), 0.5 * (y1 - y0)
    dx1, dy1 = dx0, dy0

    # Cria o parâmetro t
    t = np.linspace(0, 1, num=100)

    # Calcula as coordenadas x e y da curva cúbica de Hermite com C2
    x = x0 * (2*t**3 - 3*t**2 + 1) + x1 * (-2*t**3 + 3*t**2) + dx0 * (t**3 - 2*t**2 + t) + dx1 * (t**3 - t**2)
    y = y0 * (2*t**3 - 3*t**2 + 1) + y1 * (-2*t**3 + 3*t**2) + dy0 * (t**3 - 2*t**2 + t) + dy1 * (t**3 - t**2)

    return x, y

# Pontos para a interpolação cúbica de Hermite
hermite_points = [(0, 0), (2, 1)]

# Calcula a curva cúbica de Hermite
hermite_x, hermite_y = hermite_cubic_interp(hermite_points)

# Pontos para a interpolação cúbica de Bézier
bezier_points = [(0, 0), (1, 2), (3, 1), (4, 3)]

# Calcula a curva cúbica de Bézier
bezier_x, bezier_y = bezier_cubic_interp(bezier_points)

# Pontos para a interpolação cúbica de Hermite com C2
hermite_c2_points = [(0, 0), (2, 1)]

# Calcula a curva cúbica de Hermite com C2
hermite_c2_x, hermite_c2_y = hermite_cubic_interp_c2(hermite_c2_points)

# Plota as curvas
plt.figure(figsize=(8, 6))
plt.plot(hermite_x, hermite_y, label='Curva de Hermite (C1)')
plt.plot(bezier_x, bezier_y, label='Curva de Bézier (C1)')
plt.plot(hermite_c2_x, hermite_c2_y, label='Curva de Hermite (C2)')
plt.scatter(*zip(*hermite_points), color='red', label='Pontos de Controle (Hermite)')
plt.scatter(*zip(*bezier_points), color='blue', label='Pontos de Controle (Bézier)')
plt.scatter(*zip(*hermite_c2_points), color='green', label='Pontos de Controle (Hermite C2)')
plt.legend()
plt.xlabel('X')
plt.ylabel('Y')
plt.title('Interpolação Cúbica de Hermite e Bézier (C1 e C2)')
plt.grid(True)
plt.show()
