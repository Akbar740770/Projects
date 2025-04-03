import { Component, EventEmitter, Input, Output } from "@angular/core";
import { TruncatePipe } from "../../pipes/truncate.pipe";


@Component({
  selector: 'app-todo-card',
  templateUrl: './todo-card.component.html',
  styleUrl: './todo-card.component.scss',
  standalone: true,
  imports: [TruncatePipe],
})
export class TodoCardComponent {
form: any;

  @Input()
  todo: any;

  @Output()
  deleteTodo = new EventEmitter();

  OnDeleteTodo(todoId: number) {
    this.deleteTodo.emit(todoId);
  }
}