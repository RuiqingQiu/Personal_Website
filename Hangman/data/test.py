word = []
count = []
with open ('5_words_unigram') as File:
    for line in File:
        tmp = line.split()
        word.append(tmp[0])
        count.append(int(tmp[1]))

print word
print count
total = 0.0
for x in count:
    total = total + x
print total
index = 0
tmp = 0.0
for x in word:
    if 'E' in x:
        tmp = tmp + count[index]
    index = index + 1
print tmp


print tmp/total
