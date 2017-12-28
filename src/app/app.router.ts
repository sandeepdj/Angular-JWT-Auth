import { NgModule } from '@angular/core';

import {ExtraOptions,Routes, RouterModule} from "@angular/router";
import { LoginComponent } from './components/login/login.component';
import { HeaderComponent } from './components/header/header.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';

const ROUTES: Routes = [
    {path: '', redirectTo: 'Login', pathMatch: 'full'},
    { path: 'Login', component: LoginComponent }
];

const config: ExtraOptions = {
    useHash: true,
};
  
  @NgModule({
    imports: [RouterModule.forRoot(ROUTES, config)],
    exports: [RouterModule],
  })
  export class AppRoutingModule {
  }  