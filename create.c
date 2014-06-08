#include <stdio.h>

int t = 0;
int main() {
    char a[5] = {'0', '0', '0', '0', '0'}; //注意程序中的5和4就行了（这是5位的例子）
    int f = 0, i;
    int getnext(char *);
    while (t >= 0) {
        if (t == 4) {
            for (i = 0; i < 5; i++) {
                printf("%c", a[i]);
            }
            printf("\n");
            f = getnext(a + 4);
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
        *c = 'a'; //改成A，下面改成Z则生成的都是大写字母
    } else if (*c == 'z') {
        t--;
        *c = '0';
        return 1;
    } else {
        (*c)++;
    }

    return 0;
}
