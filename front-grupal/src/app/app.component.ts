import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../environments/environment';
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.sass']
  
})

export class AppComponent {
  
  

  // Mapas para consultas rápidas
  propietariosPorId: { [id: number]: any } = {};
  mascotasPorId: { [id: number]: any } = {};

  // ----------------------
  // PROPIETARIOS
  // ----------------------
  propietarios: any[] = [];
  nuevoPropietario: any = { nombre: '', apellido_p: '', apellido_m: '', ci: '', telefono: '', direccion: '' };
  propietarioEditando: any = null;
  baseUrlPropietario = `${environment.apiUrl}/propietarios`;

  // ----------------------
  // MASCOTAS
  // ----------------------
  mascotas: any[] = [];
  nuevaMascota: any = { nom_mascota: '', raza: '', edad: '', color: '', id_propietario: '' };
  mascotaEditando: any = null;
  baseUrlMascota = `${environment.apiUrl}/mascotas`;

  // ----------------------
  // CITAS
  // ----------------------
  citas: any[] = [];
  citasFiltradas: any[] = [];
  nuevaCita: any = { id_mascota: '', fecha: '', hora: '', servicio: '' };
  citaEditando: any = null;
  
  baseUrlCita = `${environment.apiUrl}/citas`;
  filtroFecha: string = '';
  

  constructor(private http: HttpClient) {}

  
  ngOnInit() {
    this.listarPropietarios();
    this.listarMascotas();
    this.listarCitas();
  }

  // ----------------------
  // MÉTODOS CRUD PROPIETARIOS
  // ----------------------
  listarPropietarios() {
    this.http.get<any[]>(this.baseUrlPropietario).subscribe({
      next: data => {
        this.propietarios = data;
        this.propietariosPorId = {};
        data.forEach(p => this.propietariosPorId[p.id_propietario] = p);
        this.listarMascotas(); // recarga mascotas para nombres
      },
      error: err => console.error('Error al listar propietarios', err)
    });
  }

  mostrarAdvertencia = false;
  crearPropietario(form: NgForm) {
    if (!form.valid) { this.mostrarAdvertencia = true; return; }
    this.mostrarAdvertencia = false;
    this.http.post(this.baseUrlPropietario, this.nuevoPropietario).subscribe({
      next: () => { this.resetFormularioPropietario(); this.listarPropietarios(); form.resetForm(); },
      error: err => console.error('Error al crear propietario', err)
    });
  }

  editarPropietario(propietario: any) { this.propietarioEditando = { ...propietario }; }
  actualizarPropietario() {
    this.http.put(`${this.baseUrlPropietario}/${this.propietarioEditando.id_propietario}`, this.propietarioEditando).subscribe({
      next: () => { this.propietarioEditando = null; this.listarPropietarios(); },
      error: err => console.error('Error al actualizar propietario', err)
    });
  }
  cancelarEdicion() { this.propietarioEditando = null; }
  eliminarPropietario(id: number) {
    this.http.delete(`${this.baseUrlPropietario}/${id}`).subscribe({
      next: () => this.listarPropietarios(),
      error: err => console.error('Error al eliminar propietario', err)
    });
  }
  private resetFormularioPropietario() { this.nuevoPropietario = { nombre: '', apellido_p: '', apellido_m: '', ci: '', telefono: '', direccion: '' }; }

  // ----------------------
  // MÉTODOS CRUD MASCOTAS
  // ----------------------
  listarMascotas() {
    this.http.get<any[]>(this.baseUrlMascota).subscribe({
      next: data => {
        this.mascotas = data;
        this.mascotasPorId = {};
        data.forEach(m => this.mascotasPorId[m.id_mascota] = m);
        this.mascotas.forEach(m => {
          const p = this.propietariosPorId[m.id_propietario];
          m.nombrePropietario = p ? `${p.nombre} ${p.apellido_p} ${p.apellido_m}` : 'Desconocido';
        });
        this.listarCitas();
      },
      error: err => console.error('Error al listar mascotas', err)
    });
  }

  mostrarAdvertenciaMascota = false;
  crearMascota(form: NgForm) {
    if (!form.valid) { this.mostrarAdvertenciaMascota = true; return; }
    this.mostrarAdvertenciaMascota = false;
    this.http.post(this.baseUrlMascota, this.nuevaMascota).subscribe({
      next: () => { this.resetFormularioMascota(); this.listarMascotas(); form.resetForm(); },
      error: err => console.error('Error al crear mascota', err)
    });
  }

  editarMascota(mascota: any) { this.mascotaEditando = { ...mascota }; }
  actualizarMascota() {
    this.http.put(`${this.baseUrlMascota}/${this.mascotaEditando.id_mascota}`, this.mascotaEditando).subscribe({
      next: () => { this.mascotaEditando = null; this.listarMascotas(); },
      error: err => console.error('Error al actualizar mascota', err)
    });
  }
  cancelarEdicionMascota() { this.mascotaEditando = null; }
  eliminarMascota(id: number) {
    this.http.delete(`${this.baseUrlMascota}/${id}`).subscribe({
      next: () => this.listarMascotas(),
      error: err => console.error('Error al eliminar mascota', err)
    });
  }
  private resetFormularioMascota() { this.nuevaMascota = { nom_mascota: '', raza: '', edad: '', color: '', id_propietario: '' }; }

  // ----------------------
  // MÉTODOS CRUD CITAS
  // ----------------------
  listarCitas() {
    this.http.get<any[]>(this.baseUrlCita).subscribe({
      next: data => {
        this.citas = data;
  
        // Mapear nombres de mascota y propietario
        this.citas.forEach(c => {
          const m = this.mascotasPorId[c.id_mascota];
          if (m) { 
            c.nombreMascota = m.nom_mascota; 
            c.nombrePropietario = m.nombrePropietario; 
          } else { 
            c.nombreMascota = 'Desconocida'; 
            c.nombrePropietario = 'Desconocido'; 
          }
        });
  
        // Inicializar filtroFecha con fecha de hoy si está vacío
        if (!this.filtroFecha) {
          const hoy = new Date();
          const yyyy = hoy.getFullYear();
          const mm = String(hoy.getMonth() + 1).padStart(2, '0');
          const dd = String(hoy.getDate()).padStart(2, '0');
          this.filtroFecha = `${yyyy}-${mm}-${dd}`;
        }
  
        // Aplicar filtro automático
        this.aplicarFiltro();
      },
      error: err => console.error('Error al listar citas', err)
    });
  }

  mostrarAdvertenciaCita = false;
  crearCita(form: NgForm) {
    if (!form.valid) { this.mostrarAdvertenciaCita = true; return; }
    this.mostrarAdvertenciaCita = false;
    this.http.post(this.baseUrlCita, this.nuevaCita).subscribe({
      next: () => { this.resetFormularioCita(); this.listarCitas(); form.resetForm(); },
      error: err => console.error('Error al crear cita', err)
    });
  }

  editarCita(cita: any) {
    this.citaEditando = { ...cita };
    if (this.citaEditando.hora) this.citaEditando.hora = this.citaEditando.hora.slice(0,5);
  }
  actualizarCita() {
    const datos = { id_mascota: Number(this.citaEditando.id_mascota), fecha: this.citaEditando.fecha, hora: this.citaEditando.hora, servicio: this.citaEditando.servicio };
    this.http.put(`${environment.apiUrl}/citas/${this.citaEditando.id_cita}`, datos).subscribe({
      next: () => { this.listarCitas(); this.citaEditando = null; },
      error: err => console.error('Error al actualizar cita', err)
    });
  }
  cancelarEdicionCita() { this.citaEditando = null; }
  eliminarCita(id: number) {
    this.http.delete(`${this.baseUrlCita}/${id}`).subscribe({
      next: () => this.listarCitas(),
      error: err => console.error('Error al eliminar cita', err)
    });
  }
  private resetFormularioCita() { this.nuevaCita = { id_mascota: '', fecha: '', hora: '', servicio: '' }; }

  aplicarFiltro() {
    if (this.filtroFecha) {
      // Filtra por fecha
      this.citasFiltradas = this.citas
        .filter(c => c.fecha === this.filtroFecha)
        .sort((a, b) => {
          // Convierte la hora en minutos para comparar
          const [h1, m1] = a.hora.split(':').map(Number);
          const [h2, m2] = b.hora.split(':').map(Number);
          return h1 * 60 + m1 - (h2 * 60 + m2);
        });
    } else {
      this.citasFiltradas = [];
    }
  }

  cancelarBusqueda() {
  this.citasFiltradas = [];
  this.filtroFecha = '';
}
  resetFiltro() {
    const hoy = new Date();
    const yyyy = hoy.getFullYear();
    const mm = String(hoy.getMonth() + 1).padStart(2, '0');
    const dd = String(hoy.getDate()).padStart(2, '0');
    this.filtroFecha = `${yyyy}-${mm}-${dd}`;
    this.aplicarFiltro();
  }
}
