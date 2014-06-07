#include <stdio.h>

int t = 0;
int main() {
    char a[2] = {'0','0'};
    int f = 0, i;
    int getnext(char *);
    while (t >= 0) {
        if (t == 1) {
            for (i = 0; i < 2; i++) {
                printf("%c", a[i]);
            }
            printf("\n");
            f = getnext(a + 1);
        } else if (f) {
            f = getnext(a + t);
        } else {
            t++;
        }
    }
    
    return 0;
}

int getnext(char *c) {
    if (*c == '9') {
        *c = 'A';
    } else if (*c == 'Z') {
        t--;
        *c = '0';
        return 1;
    } else {
        (*c)++;
    }

    return 0;
}
