import { AsyncPipe, NgFor } from '@angular/common';
import { ChangeDetectionStrategy, Component, inject } from '@angular/core';
import { TodoCardComponent } from './todo-card/todo-card.component';
import { TodosApiService } from '../todos-api.service';
import { TodosService } from '../todos.service';
import { CreatetodosFormComponent } from "../create-todos-form/create-todos-form.component";
export interface Todo {
  userId: number;
  id: number;
  title: string;
  completed: boolean;
}

  // id: number;
  // name: string;
  // username: string;
  // email: string;

  // address?: {
  //   street: string;
  //   suite: string;
  //   city: string;
  //   zipcode: string;

  //   geo: {
  //     lat: string;
  //     lng: string;
  //   };
  // };
  // phone?: string;
  // website?: string;

  // company?: {
  //   name: string;
  //   catchPhrase: string;
  //   bs: string;
  // };


@Component({
  selector: 'app-todo-list',
  templateUrl: './todos-list.component.html',
  styleUrl: './todos-list.component.scss',
  standalone: true,
  imports: [NgFor, TodoCardComponent, AsyncPipe, CreatetodosFormComponent],
  changeDetection: ChangeDetectionStrategy.OnPush,
})
export class TodosListComponent {
  readonly TodoApiService = inject(TodosApiService);
  readonly TodosService = inject(TodosService);

  constructor() {
    this.TodoApiService.getTodos().subscribe((response: any) => {
      this.TodosService.setUser(response);
    });
  }

  deleteUsers(id: number) {
    this.TodosService.deleteUser(id);
  }

  public createTodos(formItem: Todo) 
  {
    this.TodosService.createTodo({
      id: new Date().getTime(),
      title: formItem.title,
      userId: formItem.userId,
      completed: formItem.completed,
    });
  }
}
