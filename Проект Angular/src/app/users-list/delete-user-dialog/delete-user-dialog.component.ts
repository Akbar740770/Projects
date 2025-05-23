import { Component, inject } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialog, MatDialogModule } from '@angular/material/dialog';
import { User } from '../users-list.component';
import { MatButton } from '@angular/material/button';
import { MatButtonModule } from '@angular/material/button';

@Component({
  selector: 'app-delete-user-dialog',
  standalone: true,
  imports: [MatDialogModule, MatButton,MatButtonModule],
  templateUrl: './delete-user-dialog.component.html',
  styleUrl: './delete-user-dialog.component.scss',
})
export class DeleteUserDialogComponent {
  public readonly data = inject<{ user: User }>(MAT_DIALOG_DATA);
}
