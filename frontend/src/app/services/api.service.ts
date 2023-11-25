import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, firstValueFrom } from 'rxjs';


@Injectable({
  providedIn: 'root'
})
export class ApiService {

  private url:string = 'http://127.0.0.1:8000/api';

  constructor(private http:HttpClient) {
  }

  getToken(): string | null {
    return localStorage.getItem('token');
  }

  //loggear un usuario
  login(formValue: any) {
    return firstValueFrom(this.http.post<any>(this.url+'/login', formValue));
  }

  //Visualizar usuarios
  getUsers():Observable<any> {
    const token=this.getToken();
    if(token){
      const headers = new HttpHeaders().set('Authorization', 'bearer'+token)
      return this.http.get(this.url+'/admin/users', {headers});
    } else{
      console.log('Token no encontrado');
      return new Observable();
      }
    }

  //Crear usuario
  createUser(user:any){
    const token=this.getToken();
    if(token){
      const headers = new HttpHeaders().set('Authorization', 'bearer'+token);
      return firstValueFrom(this.http.post(this.url+'/admin/users', user ,{headers}));
    } else{
      console.log('Token no encontrado');
      return new Observable();
      }
    }

  //Eliminar Usuario
  deleteUser(rut: string): Observable<any> {
    const token = this.getToken();
    if (token) {
      const headers = new HttpHeaders().set('Authorization', 'Bearer ' + token);
      return this.http.delete(this.url+'/admin/users/'+rut, { headers });
    } else {
      console.log('Token no encontrado');
      return new Observable();
    }
  }

  //Editar Usuario
  editUser(rut: string): Observable<any> {
    const token = this.getToken();
    if (token) {
      const headers = new HttpHeaders().set('Authorization', 'Bearer ' + token);
      return this.http.put(this.url+'/admin/users/'+rut, { headers });
    } else {
      console.log('Token no encontrado');
      return new Observable();
    }
  }

  //Buscar por rut
  getRut(rut: string): Observable<any> {
    const token = this.getToken();
    if (token) {
      const headers = new HttpHeaders().set('Authorization', 'Bearer ' + token);
      return this.http.get(this.url+'/admin/users/rut/'+rut, { headers });
    } else {
      console.log('Token no encontrado');
      return new Observable();
    }
  }

  //Buscar por email
  getEmail(email: string): Observable<any> {
    const token = this.getToken();
    if (token) {
      const headers = new HttpHeaders().set('Authorization', 'Bearer ' + token);
      return this.http.get(this.url+'/admin/users/email/'+email, { headers });
    } else {
      console.log('Token no encontrado');
      return new Observable();
    }
  }
}
