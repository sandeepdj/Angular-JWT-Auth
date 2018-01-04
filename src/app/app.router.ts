import { NgModule } from '@angular/core';
import { ExtraOptions,Routes, RouterModule} from "@angular/router";
 
import { 
  LoginComponent,
  HeaderComponent,
  SidebarComponent,
  LayoutComponent,
  FooterComponent
 } from './components/index';
import { 
  DashboardComponent,
  HomeComponent,
} from './modules/index';

import { 
  C404Component,
  C401HComponent,
} from './http-status/index';

import { AuthGuard } from './services/index';

const ROUTES: Routes = [
    {path: '', redirectTo: 'Login', pathMatch: 'full'},
    { path: 'Login', component: LoginComponent },
    { 
      path: 'app', component: LayoutComponent,canActivate: [AuthGuard], 
      children: [
        {path: '', redirectTo: 'Home',pathMatch: 'full'}, 
        {path: 'Home', component: HomeComponent}, 
        {path: 'Dashboard', component: DashboardComponent}, 
      ]
    },
    { path: 'Unauthorized', component: C401HComponent },
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