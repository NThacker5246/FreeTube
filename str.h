#pragma once

void strfind(char *source, const char* text, char* &out) {
	for (int i = 0; i < strlen(source); i++) {
		if (source[i] == text[0]) {
			bool res = 1;
			for (int j = 1; j < strlen(text); j++) {
				if (source[i + j] != text[j]) {
					res = 0;
					i += j;
					break;
				}
			}
			if (res) {
				i += strlen(text) + 1;
				int j = 0;
				for (;;) {
					if (source[i] == ' ') return;
					*&out[j] = source[i];
					i += 1;
					j += 1;
				}
			}
		}
	}
}

char* getExtension(char* source) {
	for (int i = 0;; i++) {
		if (source[i] == '.') {
			return source + i;
		}
	}
}