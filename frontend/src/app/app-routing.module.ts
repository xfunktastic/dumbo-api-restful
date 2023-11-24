import { LoginComponent } from './views/login/login.component';
import { CreateUserComponent } from './views/create-user/create-user.component';
import { NgModule, Component } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { FindUsersComponent } from './views/find-users/find-users.component';
import { DashboardComponent } from './views/dashboard/dashboard.component';
import { EditUserComponent } from './views/edit-user/edit-user.component';
import { DeleteUserComponent } from './views/delete-user/delete-user.component';
import { GetUserEmailComponent } from './views/get-user-email/get-user-email.component';
import { GetUserRutComponent } from './views/get-user-rut/get-user-rut.component';
import { loginGuard } from './guards/login.guard';

const routes: Routes = [
  {path: '',redirectTo:'login', pathMatch:'full'},
  {path: 'login',component: LoginComponent},
  {path: 'dashboard',component: DashboardComponent, canActivate: [loginGuard]},
  {path: 'show',component: FindUsersComponent, canActivate: [loginGuard]},
  {path: 'create/new',component: CreateUserComponent, canActivate: [loginGuard]},
  {path: 'edit:rut_dni',component: EditUserComponent, canActivate: [loginGuard]},
  {path: 'delete:rut_dni',component: DeleteUserComponent, canActivate: [loginGuard]},
  {path: 'getRut:rut_dni',component: GetUserRutComponent, canActivate: [loginGuard]},
  {path: 'getEmail:email',component: GetUserEmailComponent, canActivate: [loginGuard]},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }

export const routingComponents = [LoginComponent, DashboardComponent, FindUsersComponent, CreateUserComponent, EditUserComponent, DeleteUserComponent, GetUserEmailComponent, GetUserRutComponent]
