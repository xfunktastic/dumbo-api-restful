import { Component, OnInit } from '@angular/core';
import { ApiService } from 'src/app/services/api.service';  // Asegúrate de especificar la ruta correcta hacia tu servicio

@Component({
  selector: 'app-find-users',
  templateUrl: './find-users.component.html',
  styleUrls: ['./find-users.component.css']
})
export class FindUsersComponent implements OnInit {
  users: any[] = [];

  constructor(private apiService: ApiService) { }

  ngOnInit(){
    this.getUsers();
  }

  getUsers() {
    this.apiService.getUsers().subscribe((response:any)=>{
      this.users = response.users;
    });
  }
}
