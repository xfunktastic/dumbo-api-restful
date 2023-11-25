import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from 'src/app/services/api.service';  // Asegúrate de especificar la ruta correcta hacia tu servicio

@Component({
  selector: 'app-find-users',
  templateUrl: './find-users.component.html',
  styleUrls: ['./find-users.component.css']
})
export class FindUsersComponent implements OnInit {
  users: any[] = [];
  rutSelected: string | null = null;

  constructor(private apiService: ApiService, private router:Router) { }

  ngOnInit(){
    this.getUsers();
  }

  getUsers() {
    this.apiService.getUsers().subscribe((response:any)=>{
      this.users = response.users;});
  }

  deleteUser(rut: string): void {
    this.rutSelected = rut;
    this.apiService.deleteUser(rut).subscribe();
  }

  editUser(rut: string): void {
    this.rutSelected = rut;
    this.apiService.editUser(rut).subscribe();
    this.router.navigate(['edit']);
  }
}
