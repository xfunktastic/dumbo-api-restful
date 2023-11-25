import { LoginComponent } from './views/login/login.component';
import { CreateUserComponent } from './views/create-user/create-user.component';
import { NgModule, Component } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { FindUsersComponent } from './views/find-users/find-users.component';
import { GetUserEmailComponent } from './views/get-user-email/get-user-email.component';
import { GetUserRutComponent } from './views/get-user-rut/get-user-rut.component';
import { loginGuard } from './guards/login.guard';
import { EditUserComponent } from './views/edit-user/edit-user.component';

const routes: Routes = [
  {path: '',redirectTo:'login', pathMatch:'full'},
  {path: 'login',component: LoginComponent},
  {path: 'show',component: FindUsersComponent, canActivate: [loginGuard]},
  {path: 'create/new',component: CreateUserComponent, canActivate: [loginGuard]},
  {path: 'getRut',component: GetUserRutComponent, canActivate: [loginGuard]},
  {path: 'getEmail',component: GetUserEmailComponent, canActivate: [loginGuard]},
  {path: 'edit',component: EditUserComponent, canActivate: [loginGuard]}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }

export const routingComponents = [LoginComponent, FindUsersComponent, CreateUserComponent, GetUserEmailComponent, GetUserRutComponent, EditUserComponent]
