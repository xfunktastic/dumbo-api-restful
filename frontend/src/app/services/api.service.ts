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
}
