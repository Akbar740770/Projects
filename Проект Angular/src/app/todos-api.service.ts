import { HttpClient } from "@angular/common/http";
import { inject, Injectable } from "@angular/core";


@Injectable({ providedIn: 'root' })

export class TodosApiService {
  readonly http = inject(HttpClient);

  getTodos() {
    return this.http.get('https://jsonplaceholder.typicode.com/todos');
  }
}