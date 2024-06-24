from graphviz import Digraph

# Create a new directed graph
dot = Digraph()

# Define nodes for classes
dot.node('Hotel', 'Hotel\n- habitaciones: List<Habitacion>\n- clientes: List<Cliente>\n- reservas: List<Reserva>\n+ obtenerHabitacionesDisponibles(tipo: TipoHabitacion): List<Habitacion>\n+ obtenerPrecioHabitacion(tipo: TipoHabitacion): float\n+ obtenerDescuentoHabituales(): float\n+ obtenerPrecioTotal(dni: string, tipo: TipoHabitacion, noches: int): float\n+ dibujarHabitacion(tipo: TipoHabitacion): void\n+ reservarHabitacion(numHabitacion: int, cliente: Cliente): void\n+ eliminarReserva(numHabitacion: int): void\n+ cambiarPrecioHabitacion(tipo: TipoHabitacion, nuevoPrecio: float): void\n+ cambiarDescuentoHabituales(nuevoDescuento: float): void\n+ calcularGanancias(mes: int): float')

dot.node('Habitacion', 'Habitacion\n- numero: int\n- tipo: TipoHabitacion\n- precio: float\n- disponible: bool\n+ esDisponible(): bool')
dot.node('Simple', 'Simple\n+ esDisponible(): bool')
dot.node('Doble', 'Doble\n+ esDisponible(): bool')
dot.node('Matrimonial', 'Matrimonial\n+ esDisponible(): bool')

dot.node('Cliente', 'Cliente\n- nombre: string\n- dni: string\n- tipo: TipoCliente\n+ obtenerDescuento(): float')
dot.node('Habitual', 'Habitual\n+ obtenerDescuento(): float')
dot.node('Esporadico', 'Esporadico\n+ obtenerDescuento(): float')

dot.node('Reserva', 'Reserva\n- cliente: Cliente\n- habitacion: Habitacion\n- fechaInicio: date\n- numeroDias: int\n+ obtenerPrecioTotal(): float')

dot.node('TipoHabitacion', 'TipoHabitacion')
dot.node('TipoCliente', 'TipoCliente')

# Define edges between classes to represent relationships
dot.edge('Hotel', 'Habitacion', label='contains')
dot.edge('Hotel', 'Cliente', label='contains')
dot.edge('Hotel', 'Reserva', label='contains')
dot.edge('Habitacion', 'Simple', label='inherits')
dot.edge('Habitacion', 'Doble', label='inherits')
dot.edge('Habitacion', 'Matrimonial', label='inherits')
dot.edge('Cliente', 'Habitual', label='inherits')
dot.edge('Cliente', 'Esporadico', label='inherits')
dot.edge('Reserva', 'Cliente', label='references')
dot.edge('Reserva', 'Habitacion', label='references')
dot.edge('Habitacion', 'TipoHabitacion', label='uses')
dot.edge('Cliente', 'TipoCliente', label='uses')

# Render the graph as a PNG image
dot.format = 'png'
file_path = '/mnt/data/hotel_class_diagram.png'
dot.render(file_path)

file_path
